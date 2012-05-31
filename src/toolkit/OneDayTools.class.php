<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');

class OneDayTools extends lmbAbstractTools
{
  protected $user;

  function getUser()
  {
    if(null != $this->user)
      return $this->user;

    $this->user = lmbToolkit :: instance()->getSession()->get('User');

    return $this->user;
  }

  function resetUser()
  {
    $this->user = null;
    lmbToolkit :: instance()->getSession()->destroy('User');
  }

  function setUser($user)
  {
    $this->user = $user;
    lmbToolkit::instance()->getSession()->set('User', $user);
  }
}


