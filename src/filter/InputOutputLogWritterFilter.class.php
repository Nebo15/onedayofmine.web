<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/net/src/lmbIp.class.php');

class InputOutputLogWritterFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $toolkit = lmbToolkit::instance();
    $log = new odRequestsLog();

    $is_admin_page = '/admin' === substr($_SERVER['REQUEST_URI'], 0, 6);

    if(!$is_admin_page)
      $log->addRequestRecord($toolkit->getRequest());

    $filter_chain->next();

    if(!$is_admin_page)
      $log->addResponseRecord($toolkit->getResponse());
  }
}

