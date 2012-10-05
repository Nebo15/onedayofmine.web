<?php

class odJobQueueClientForTests extends odAsyncJobs
{
  function doBackground($name, $encoded_workload)
  {
    $workload = self::decodeWorkload($encoded_workload);
    $class = get_called_class();
    $obj = new $class;
    $obj->job = new GearmanJob();
    $method_name = '_'.$name;
    call_user_func_array(array($obj, $method_name), $workload);
  }
}
