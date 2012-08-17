<?php
lmb_require(taskman_prop('PROJECT_DIR').'setup.php');

/**
 * @desc Remove RemoteApiMock cache
 */
function task_od_remove_cache($argv)
{
  lmb_require('limb/fs/src/lmbFs.class.php');
  lmbFs::rm(taskman_prop('PROJECT_DIR').'/var');
  lmbFs::mkdir(taskman_prop('PROJECT_DIR').'/var');
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

function task_od_amazon_watch()
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
