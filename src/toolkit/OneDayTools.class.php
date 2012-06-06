<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('facebook/facebook.php');

class OneDayTools extends lmbAbstractTools
{
  protected $user;
  /**
   * @var Facebook
   */
  protected $facebook;

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

  /**
   * @return Facebook
   */
  function getUserFacebook()
  {
    $user = $this->getUser();
    lmb_assert_true($user);
    return $this->getFacebook($user->getFbAccessToken());
  }

  /**
   * @param string $access_token
   * @return Facebook
   */
  function getFacebook($access_token)
  {
    if(null != $this->facebook)
      return $this->facebook;

    $this->facebook = new Facebook(array(
      'appId'  => lmbToolkit::instance()->getConf('common')->get('fb_app_id'),
      'secret' => lmbToolkit::instance()->getConf('common')->get('fb_app_secret'),
    ));

    $this->facebook->setAccessToken($access_token);

    return $this->facebook;
  }
}


