<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/session/src/lmbSession.class.php');
lmb_require('limb/session/src/lmbSessionNativeStorage.class.php');

class SessionStartupFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $sessid = lmbToolkit::instance()->getSessidFromRequest();
    $session = lmbToolkit :: instance()->getSession();
    if($sessid)
      $session->start(new lmbSessionNativeStorage(), $sessid);
    else
      $session->start(new lmbSessionNativeStorage());
    $filter_chain->next();
  }
}

