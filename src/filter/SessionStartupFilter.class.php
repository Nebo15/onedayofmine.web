<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/session/src/lmbSession.class.php');
lmb_require('limb/session/src/lmbSessionNativeStorage.class.php');

class SessionStartupFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $filter_chain->next();
  }
}

