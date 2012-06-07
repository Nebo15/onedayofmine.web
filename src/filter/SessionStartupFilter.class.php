<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/session/src/lmbSession.class.php');
lmb_require('limb/session/src/lmbSessionNativeStorage.class.php');

class lmbSessionStartupFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $session_id_name = lmb_env_get('SESSION_COOKIE_NAME');
    $session_id = null;
    if(isset($_COOKIE[$session_id_name]))
      $session_id = $_COOKIE[$session_id_name];
    if(isset($_GET[$session_id_name]))
      $session_id = $_GET[$session_id_name];
    if(isset($_POST[$session_id_name]))
      $session_id = $_POST[$session_id_name];
    $session = lmbToolkit :: instance()->getSession();
    $session->start(new lmbSessionNativeStorage(), $session_id);
    $filter_chain->next();
  }
}

