<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('src/service/social_provider/odFacebook.class.php');
lmb_require('src/service/social_provider/odTwitter.class.php');
lmb_require('src/service/social_profile/FacebookProfile.class.php');
lmb_require('src/service/social_profile/TwitterProfile.class.php');
lmb_require('src/service/social_profile/FakeProfile.class.php');
lmb_require('src/service/odNewsObserver.class.php');
lmb_require('src/service/odRemoteApiMock.class.php');

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
    if(null === $path)
      return null;
    return lmb_env_get('STATIC_HOST_URL').$path;
  }

  function getAbsolutePath($www_path)
  {
    return lmb_env_get('APP_DIR')."/www/".$www_path;
  }

  function loadTestsUsersInfo()
  {
  	$fb = $this->toolkit->getFacebook();
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
      $user->import($this->getFacebookProfile($user)->getInfo());
      $users['data'][$key]['email'] = $user->getEmail();
    }
  	return $users['data'];
  }

  /**
   * @param User $user
   * @return FacebookProfile
   */
  function getFacebookProfile(User $user)
  {
    lmb_assert_true($user);
    if(0 == $user->getSettings()->getSocialShareFacebook())
      return new FakeProfile($user);

    lmb_assert_true($user->getFbAccessToken(), 'Facebook access token not specified.');
    return new FacebookProfile($user);
  }

  /**
   * @param User $user
   * @return TwitterProfile
   */
  function getTwitterProfile(User $user)
  {
    lmb_assert_true($user);
    if(0 == $user->getSettings()->getSocialShareTwitter())
      return new FakeProfile($user);

    lmb_assert_true($user->getTwitterAccessToken(), 'Twitter access token not specified.');
    lmb_assert_true($user->getTwitterAccessTokenSecret(), 'Twitter access token secret not specified.');
    return new TwitterProfile($user);
  }

  /**
   * Create odTwitter instance with or without auth.
   *
   * @param  string $access_token
   * @param  string $access_token_secret
   * @return odTwitter
   */
  public function getTwitter($access_token = null, $access_token_secret = null)
  {
    static $twitter_instances = array();

    if(!array_key_exists($access_token, $twitter_instances)) {
      $config = odTwitter::getConfig();

      if(!is_null($access_token) && !is_null($access_token_secret)) {
        $config['user_token']  = $access_token;
        $config['user_secret'] = $access_token_secret;
      }

      $twitter_instances[$access_token] = new odTwitter($config);

      if(lmb_env_get('USE_API_CACHE'))
        $twitter_instances[$access_token] = new odRemoteApiMock(
          $twitter_instances[$access_token],
          lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/twitter_cache/'.$access_token)
        );

    }

    return $twitter_instances[$access_token];
  }

  /**
   * Create odFacebook instance with or without auth.
   *
   * @param  string $access_token
   * @return odFacebook
   */
  public function getFacebook($access_token = null)
  {
    static $facebook_instances = array();

    if(!array_key_exists($access_token, $facebook_instances)) {
      // NOTICE: connection can be cached
      $instance = new odFacebook(odFacebook::getConfig());

      if(!is_null($access_token))
        $instance->setAccessToken($access_token);

      if(lmb_env_get('USE_API_CACHE'))
        $facebook_instances[$access_token] = new odRemoteApiMock(
          $instance,
          lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/facebook_cache/'.$access_token)
        );
      else
        $facebook_instances[$access_token] = $instance;
    }

    return $facebook_instances[$access_token];
  }
}


