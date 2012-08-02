<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('src/social_services/provider/*.class.php');
lmb_require('src/social_services/user/*.class.php');
lmb_require('src/odSocialServices.class.php');
lmb_require('src/odNewsObserver.class.php');

class odTools extends lmbAbstractTools
{
  /**
   * @var User Current logged in user.
   */
  protected $user;

  function setUser(User $user)
  {
    $this->user = $user;
    lmbToolkit::instance()->getSession()->set('user_id', $user->getId());
  }

  /**
   * @return User
   */
  function getUser()
  {
    if(null != $this->user)
      return $this->user;

    $this->user = User::findById(lmbToolkit :: instance()->getSession()->get('user_id'));

    return $this->user;
  }

  function resetUser()
  {
    $this->user = null;
    lmbToolkit :: instance()->getSession()->destroy('user_id');
  }


  /**
   * @return odNewsObserver
   */
  function getNewsObserver()
  {
    static $news_observer;

    if(!$news_observer)
      $news_observer = new odNewsObserver();

    return $news_observer;
  }

  /**
   * @return odSocialServices
   */
  function getSocialServices()
  {
    static $social_services;

    if(!$social_services)
      $social_services = new odSocialServices();

    return $social_services;
  }

  /**
   * @return string
   */
  function getSessidFromRequest()
  {
    $sessid_name = lmb_env_get('SESSION_NAME');
    $request = $this->toolkit->getRequest();
    if($request->getPost($sessid_name))
      return $request->getPost($sessid_name);
    if($request->getGet($sessid_name))
      return $request->getGet($sessid_name);
    if($request->getCookie($sessid_name))
      return $request->getCookie($sessid_name);
    return '';
  }

  function getSiteUrl($path = '')
  {
    return lmb_env_get('HOST_NAME').$path;
  }

  function loadTestsUsersInfo()
  {
  	$fb = lmbToolkit::instance()->getSocialServices()->getFacebook();
  	$params = array(
  			'access_token' => $fb->getApplicationAccessToken()
  	);
  	$users = $fb->api("/".$fb->getAppId()."/accounts/test-users", "GET", $params);

    if(!$users['data'])
    {
      return array();
    }

  	return $users['data'];
  }
}


