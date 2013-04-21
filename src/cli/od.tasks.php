<?php
lmb_require(taskman_prop('PROJECT_DIR').'setup.php');

lmb_require('src/model/Day.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/model/UserSettings.class.php');
lmb_require('src/model/DeviceToken.class.php');
lmb_require('src/model/DeviceNotification.class.php');

/**
 * @param path_to_output_file
 */
function task_od_create_crontab($args = array())
{
	error_reporting(E_ALL);
	ini_set('display_errors', true);

	if(count($args) == 1)
		$output_file = array_shift($args);

	$project_dir = taskman_prop('PROJECT_DIR');
	$log_str = " >> $project_dir/var/logs/cron.log 2>&1\n";
	$output = '';

	$output .= "*/5 *	* * *	www-data cd $project_dir; ./limb od_calc_ratings $log_str";
	$output .= "*/5 *	* * *	www-data cd $project_dir; ./limb od_delete_deleted_days $log_str";
	$output .= "* *	* * *	www-data cd $project_dir; ./limb od_job_worker $log_str";

	# Sphinx
	## Users
	$sphinx_config = "--config $project_dir/settings/third-party/sphinx/sphinx.conf";
	$output .= "* * * * * sphinxsearch indexer $sphinx_config --rotate users_delta $log_str";
	$output .= "* * * * * sphinxsearch indexer $sphinx_config --rotate --merge users users_delta $log_str";
	$output .= "1 4 * * * sphinxsearch indexer $sphinx_config --rotate users $log_str";
	## Days
	$output .= "* * * * * sphinxsearch indexer $sphinx_config --rotate days_delta $log_str";
	$output .= "* * * * * sphinxsearch indexer $sphinx_config --rotate --merge days days_delta $log_str";
	$output .= "1 4	* * *	sphinxsearch indexer $sphinx_config --rotate days $log_str";

	##Notifications
	$output .= "1 7	* * *	www-data cd $project_dir; ./limb od_notify ".UserSettings::NOTIFICATIONS_PERIOD_TWICE_DAY;
	$output .= "1 17 * * *	www-data cd $project_dir; ./limb od_notify ".UserSettings::NOTIFICATIONS_PERIOD_TWICE_DAY;
	$output .= "15 7 * * *	www-data cd $project_dir; ./limb od_notify ".UserSettings::NOTIFICATIONS_PERIOD_DAILY;
	$output .= "15 7 * * 0 www-data cd $project_dir; ./limb od_notify ".UserSettings::NOTIFICATIONS_PERIOD_WEEKLY;

	if(isset($output_file))
		file_put_contents($output_file, $output);
	else
		echo $output;
}

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

function task_od_close_old_days()
{
  echo 'Search for old days...';
  $users = User::findWithOldDays();
  echo 'DONE'.PHP_EOL;
  foreach($users as $user)
  {
    $user->setCurrentDayId(null);
    $user->save();
    echo "Removed current day fo user #".$user->id.PHP_EOL;
  }
}

function task_od_delete_deleted_days()
{
	foreach(Day::findOldDeletedDays() as $day)
	{
		foreach($day->getMoments() as $moment)
			$moment->destroy();
		taskman_msg('Delete day #'.$day->id.': '.$day->title.PHP_EOL);
		$day->destroy();
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
    if(!$notification->device_token_id || 24*60*60 < $notification_age_in_secs)
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
      $notification->is_sended = 1;
      $notification->save();
    }
    catch (Zend_Mobile_Push_Exception_InvalidToken $e)
    {
      $notification->getDeviceToken()->destroy();
      $notification->destroy();
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

function task_od_job_worker()
{
  lmb_require('src/service/odAsyncJobs.class.php');

	if(!lmbToolkit::instance()->getConf('common')->async_enabled)
	{
		taskman_sysmsg('Async disabled.');
		return;
	}

  $worker= new GearmanWorker();
  $worker->addServer();
  foreach(get_class_methods('odAsyncJobs') as $function)
  {
    $worker->addFunction($function, array("odAsyncJobs", $function));
  }
  while($worker->work());
}

function task_od_bundle()
{
  set_time_limit(0);

  lmb_require('limb/bundle/src/lmbBundler.class.php');

  $bundler = new lmbBundler(get_include_path(), true);

  $files = json_decode(file_get_contents(lmb_env_get('HOST_URL').'main_page/bundle_files'))->result;

  foreach($files as $file)
    $bundler->add($file);

  $result = $bundler->makeBundle(true);

  $lines_arr = preg_split('/\n|\r/', $result);
  $num_newlines = count($lines_arr);

  $setup_file_content = file_get_contents(taskman_prop('PROJECT_DIR').'setup.php');

  $result = str_replace("require_once('limb/core/common.inc.php');", $result, $setup_file_content);

  file_put_contents(taskman_prop('PROJECT_DIR').'/bundle.php', $result);

  echo "Bundled $num_newlines lines".PHP_EOL;

//  var_dump($bundler->getIncludes());
}

function task_od_deploy()
{
  if(lmb_app_mode() == LIMB_APP_PRODUCTION) {
    $curl = curl_init("https://rpm.newrelic.com/deployments.xml");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['x-api-key:'.lmbToolkit::instance()->getConf('new_relic')->api_key]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'deployment[app_name]=ODOM');
    var_dump(curl_exec($curl));
    curl_close($curl);
  }
}

function task_od_notify($args = array())
{
	$valid_periods = [
		UserSettings::NOTIFICATIONS_PERIOD_TWICE_DAY,
		UserSettings::NOTIFICATIONS_PERIOD_DAILY,
		UserSettings::NOTIFICATIONS_PERIOD_WEEKLY
	];

	if(1 != count($args))
	{
		taskman_sysmsg("Usage: od_notify (".implode('|', $valid_periods).")\n");
		die();
	}

	$type = $args[0];
	if(!in_array($type, $valid_periods))
	{
		taskman_sysmsg("Wrong notification type '$type'. Valid values: ".implode(', ', $valid_periods)." \n");
		die();
	}

	$notifications_count = 0;
	foreach(User::findWithUnreadNews($type) as $user)
	{
		lmbToolkit::instance()
				->getFacebook($user)
				->notify($user, "You have ".$user->getNews()->count()." news", "/");
		$notifications_count++;
	}
	taskman_msg("Sended ".$notifications_count." notifications.\n");
}
