<?php
lmb_require(taskman_prop('PROJECT_DIR').'setup.php');

if(extension_loaded('newrelic'))
  newrelic_background_job(true);

/**
 * @alias od_calc_interest
 */
function task_od_calc_ratings()
{
  lmb_require('src/service/InterestCalculator.class.php');

  $calc = new InterestCalculator();
  $calc->deleteUnpinnedDays();
  $calc->fillRating();
}

function task_od_amazon_cloudwatch_update()
{
  $acw = lmbToolkit::instance()->createAmazonService('CloudWatch');

  function errors_count_requests_log()
  {
    $errors_count = RequestsLogRecord::find(array('criteria' => lmbSQLCriteria::equal('code', 500)))->count();

    return array(array(
      'MetricName'  => 'ErrorsCountFromRequestsLog' ,
      'Dimensions'  => array(array('Name' => 'Host', 'Value' => gethostname())),
      'Value'       => $errors_count,
      'Unit'        => 'Count',
      'Timestamp'   => date( DATE_RFC822)
    ));
  }

  echo "Calc errors_count_requests_log...";
  $acw->batch()->put_metric_data ('OD' ,errors_count_requests_log());
  echo 'SUCCESS'.PHP_EOL;

  echo "Sending...";
  $responses = $acw->batch()->send();
    if(!$responses->areOK())
      foreach($responses as $response)
        if(!$response->isOk())
          throw new lmbException('Error on file uploading: '.$response->body->Message);

  echo 'SUCCESS'.PHP_EOL;
}

function task_od_amazon_s3_upload()
{
  $s3 = lmbToolkit::instance()->createAmazonService('S3');
  $bucket = lmbToolkit::instance()->getConcreteAmazonServiceConfig('S3')['bucket'];
  if(!lmbToolkit::instance()->getConcreteAmazonServiceConfig('S3')['enabled'])
  {
    echo "S3 disabled".PHP_EOL;
    exit(1);
  }

  $files_dir = realpath(taskman_prop('PROJECT_DIR').'/www/users/');
  $files_dir_length = strlen($files_dir);

  $files = lmbFs::findRecursive($files_dir, 'f', '', '~.*default.*~');

  $chunk_size = 10;
  $chunks = array_chunk($files, $chunk_size);
  $counter = count($files);
  foreach($chunks as $chunk)
  {
    foreach ($chunk as $file)
    {
      $s3_file = substr($file, $files_dir_length + 1);
      $s3->batch()->create_object($bucket, $s3_file, array(
        'fileUpload' => $file,
        'acl' => AmazonS3::ACL_PUBLIC,
      ));
      echo ($counter--).':'.$s3_file.PHP_EOL;
    }

    $responses = $s3->batch()->send();
    if(!$responses->areOK())
      foreach($responses as $response)
        if(!$response->isOk())
          throw new lmbException('Error on file uploading: '.$response->body->Message);
  }
}

function task_od_close_old_days()
{
  echo 'Search for old days...';
  $users = User::findUsersWithOldDays();
  echo 'DONE'.PHP_EOL;
  foreach($users as $user)
  {
    $user->setCurrentDayId(null);
    $user->save();
    echo "Removed current day fo user #".$user->id.PHP_EOL;
  }
}

function task_od_apns_feedback()
{
  $apns = lmbToolkit::instance()->getApns();

  od_apns_connect($apns, 10);

  $tokens = $apns->feedback();
  while(list($token, $time) = each($tokens))
  {
    echo $time . "\t" . $token . PHP_EOL;
  }
  $apns->close();
}

function task_od_apns_push()
{
  $apns = lmbToolkit::instance()->getApns();

  taskman_msg("Try to connect to APNS...");
  od_apns_connect($apns, 10);
  taskman_msg("DONE".PHP_EOL);

  foreach(DeviceNotification::findNotSended() as $notification)
  {
    $notification_age_in_secs = time() - $notification->ctime;
    if(!$notification->getDeviceToken() || 24*60*60 < $notification_age_in_secs)
    {
      $notification->destroy();
      continue;
    }

    $message = new Zend_Mobile_Push_Message_Apns();
    $message->setAlert($notification->text);
    $message->setBadge($notification->icon ?: 1);
    $message->setSound($notification->sound ?: 'default');
    $message->setId($notification->id);
    $message->setToken($notification->getDeviceToken()->token);

    try
    {
      $apns->send($message);
      $notification->setIsSended(1);
      $notification->save();
    }
    catch (Zend_Mobile_Push_Exception_InvalidToken $e)
    {
      $notification->getDeviceToken()->destroy();
    }
    catch (lmbException $e)
    {
      lmbToolkit::instance()->getLog()->logException($e);
      continue;
    }

    $apns->close();
  }
}

function od_apns_connect($apns, $attempts)
{
  taskman_msg($attempts." ");
  if(!$attempts)
  {
    taskman_sysmsg("Can't connect");
    exit(1);
  }

  try
  {
    $apns->connect(Zend_Mobile_Push_Apns::SERVER_SANDBOX_URI);
  }
  catch (Zend_Mobile_Push_Exception_ServerUnavailable $e)
  {
    sleep(10);
    od_apns_connect($apns, $attempts-1);
    exit(1);
  }
  catch (Zend_Mobile_Push_Exception $e)
  {
    taskman_sysmsg('APNS Connection Error:' . $e->getMessage());
    exit(1);
  }
}
