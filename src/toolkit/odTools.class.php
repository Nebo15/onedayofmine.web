<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('src/odFacebook.class.php');
lmb_require('tests/src/odCachedFacebook.class.php');
lmb_require('src/odTwitter.class.php');
lmb_require('src/odNewsObserver.class.php');

class odTools extends lmbAbstractTools
{
  /**
   * @var User
   */
  protected $user;
  /**
   * @var array
   */
  protected $facebooks = array();
  /**
   * @var string
   */
  protected $fb_app_access_token;
  /**
   * @var odTwitter
   */
  protected $twitter;
  /**
   * @var odNewsObserver
   */
  protected $news_observer;
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

  function setUser($user)
  {
    $this->user = $user;
    lmbToolkit::instance()->getSession()->set('user_id', $user->getId());
  }

  /**
   * @return odFacebook
   */
  function getLoggedUserFacebook()
  {
    $user = $this->getUser();
    lmb_assert_true($user);
    return $this->getFacebook($user->getFbAccessToken());
  }

  function getAppFacebook()
  {
    return lmbToolkit::instance()->getFacebook();
  }

  /**
   * @param string $access_token
   * @return odFacebook
   */
  function getFacebook($access_token = null)
  {
    if(!isset($this->facebooks[$access_token]))
    {
    	$config = array(
    			'appId'  => lmbToolkit::instance()->getConf('common')->get('fb_app_id'),
    			'secret' => lmbToolkit::instance()->getConf('common')->get('fb_app_secret'),
    			'cookie' => false
     );
      $this->facebooks[$access_token] =
      	lmbToolkit::instance()->createFacebookConnection($access_token, $config);
      if($access_token)
      	$this->facebooks[$access_token]->setAccessToken($access_token);
    }

    return $this->facebooks[$access_token];
  }

  function createFacebookConnection($access_token, $config)
  {
  	if(!lmbToolkit::instance()->getConf('common')->fb_cache_enabled)
  		return new odFacebook($config);
  	else
  		return new odCachedFacebook(
  				$config,
  				lmbToolkit::instance()
  				->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/facebook_cache/'.$access_token)
  		);
  }

  /**
   * @return odTwitter
   */
  function getTwitter() {
    if(!$this->twitter)
      $this->twitter = new odTwitter();
    return $this->twitter;
  }

  /**
   * @return odNewsObserver
   */
  function getNewsObserver() {
    if(!$this->news_observer)
      $this->news_observer = new odNewsObserver();
    return $this->news_observer;
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
  	$fb = lmbToolkit::instance()->getFacebook();
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


