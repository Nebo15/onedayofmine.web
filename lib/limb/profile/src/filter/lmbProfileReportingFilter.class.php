<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/dbal/src/drivers/lmbAuditDbConnection.class.php');
lmb_require('limb/cache2/src/wrappers/lmbLoggedCacheWrapper.class.php');

set_include_path(dirname(__FILE__) . '/../../lib/PEAR' . PATH_SEPARATOR . get_include_path());

class lmbProfileReportingFilter implements lmbInterceptingFilter
{
  protected $start_time;
  protected $highlight = false;

  public function run($filter_chain)
  {
    $is_profile_enabled = lmbToolkit::instance()->isProfilingEnabled();

    if($is_profile_enabled)
    {
      $toolkit = lmbToolkit :: instance();
      $conn = new lmbAuditDbConnection($toolkit->getDefaultDbConnection());
      $toolkit->setDefaultDbConnection($conn);
      $this->start_time = microtime(true);

      $cache = $toolkit->getCache();
      $cache = new lmbLoggedCacheWrapper($cache, 'default');
      $toolkit->setCache('default', $cache);
    }

    $filter_chain->next();

    if($is_profile_enabled)
    {
    	$reporter = lmbToolkit::instance()->getProfileReporter();

    	$reporter->setScriptStatistic(
    	  microtime(true) - $this->start_time,
    	  memory_get_usage(),
    	  memory_get_peak_usage()
      );

      foreach ($conn->getStats() as $info)
        $reporter->addSqlQuery($info);

      foreach ($cache->getRuntimeStats() as $info)
        $reporter->addCacheQuery($info);

      $response = lmbToolkit::instance()->getResponse();
      $reporter->attachReport($response);
    }
  }
}
