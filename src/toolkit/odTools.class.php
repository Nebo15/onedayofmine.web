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

  function setUser($user)
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

    if(!lmbToolkit :: instance()->getSession()->get('user_id'))
      return null;

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
    $request = $this->toolkit->getRequest();
    if($request->getPost('token'))
      return $request->getPost('token');
    if($request->getGet('token'))
      return $request->getGet('token');
    if($request->getCookie('token'))
      return $request->getCookie('token');
    return null;
  }

  function getSiteUrl($path = '')
  {
    if(null === $path)
      return null;
    return lmb_env_get('HOST_URL').$path;
  }

  function getStaticUrl($path = '')
  {
    return $this->getSiteUrl($path);
  }

  function getAbsolutePath($www_path)
  {
    return lmb_env_get('APP_DIR')."/www/".$www_path;
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

    foreach ($users['data'] as $key => $value) {
      $user = new User();
      // var_dump($value);
      $user->setFbUid($value['id']);
      $user->setFbAccessToken($value['access_token']);
      $user->import($user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getInfo());
      $users['data'][$key]['email'] = $user->getEmail();
    }

  	return $users['data'];
  }
}


