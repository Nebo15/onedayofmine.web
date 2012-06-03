<?php

lmb_require('limb/profile/src/lmbProfileBaseReporter.class.php');

class lmbProfileJsonReporter extends lmbProfileBaseReporter
{
  function attachReport(lmbHttpResponse $response)
  {
    $json = json_encode(array(
      'main' => array(
        'time' => $this->script_time,
        'memory' => $this->script_memory,
        'peak memory' => $this->script_peak_memory,
      ),
      'sql' => $this->sql_queries,
      'cache' => $this->cache_queries
    ));
    $response->addHeader('X-Limb-Profile: '.$json);
  }
}
