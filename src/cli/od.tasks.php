<?php
lmb_require(taskman_prop('PROJECT_DIR').'setup.php');

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
  echo "Sending...";

  foreach(lmb_glob(taskman_prop('PROJECT_DIR').'/../*onedayofmine*.access_log') as $log_file)
  {
    $value = exec("grep ' 500 ' $log_file | wc -l");
    $log_name = str_replace('.access_log', '', basename($log_file));

    $res  =  $acw->put_metric_data ('Sys/APP' ,
      array(array('MetricName'  => 'ErrorsCount' ,
        'Dimensions'  => array(array('Name'   => 'LogName',
          'Value'  =>  $log_name)),
        'Value'       => $value,
        'Unit'        => 'Count')));
    if(!$res->isOK())
    {
      echo $res->body->Error->Code.': '.$res->body->Error->Message.PHP_EOL;
      exit(1);
    }
  }
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

//    foreach ($chunk as $file)
//    {
//      lmbFs::rm($file);
//    }
  }
}
