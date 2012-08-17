<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('src/service/social_provider/odFacebook.class.php');
lmb_require('src/service/social_provider/odTwitter.class.php');
lmb_require('src/service/social_profile/FacebookProfile.class.php');
lmb_require('src/service/social_profile/TwitterProfile.class.php');
lmb_require('src/service/odNewsObserver.class.php');
lmb_require('src/service/odRemoteApiMock.class.php');
lmb_require('src/service/ImageHelper.class.php');
lmb_require('src/service/odPostingService.class.php');
require_once('amazon-sdk/sdk.class.php');

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
   * @return odPostingService
   */
  function getPostingService(User $user = null)
  {
    static $posting_service;

    if(!$posting_service)
      $posting_service = new odPostingService();

    return $posting_service;
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
   * @return ImageHelper
   */
  function getImageHelper()
  {
    static $image_helper;

    if(!$image_helper)
      $image_helper = new ImageHelper();

    return $image_helper;
  }

  /**
   * @return string
   */
  function getSessidFromRequest()
  {
    $request = $this->toolkit->getRequest();
    if($request->getPost('token'))
      return sha1($request->getPost('token'));
    if($request->getGet('token'))
      return sha1($request->getGet('token'));
    if($request->getCookie('token'))
      return sha1($request->getCookie('token'));
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
    if(!$path)
      return null;

    return lmb_env_get('STATIC_HOST_URL').$path;
  }

  function getDayPageUrl(Day $day)
  {
    if(!$day->getId())
      throw new lmbException("Can't get day ID.");

    return $this->getSiteUrl('pages/'.$day->getId().'/day');
  }

  function getMomentPageUrl(Moment $moment)
  {
    if(!$moment->getId())
      throw new lmbException("Can't get moment ID.");

    return $this->getSiteUrl('pages/'.$moment->getId().'/moment');
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
      $user->import((new FacebookProfile($user))->getInfo());
      $users['data'][$key]['email'] = $user->getEmail();
    }
    return $users['data'];
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

  public function getConcreteAmazonServiceConfig($name)
  {
    $conf = lmbToolkit::instance()->getConf('amazon');
    if(!isset($conf[$name]))
      throw new lmbException("Can't find amazon service settings for '$name'");
    return $conf[$name];
  }

  public function createAmazonService($name)
  {
    $class_name = 'Amazon'.$name;
    CFCredentials::set(array('@default' => lmbToolkit::instance()->getConf('amazon')['options']));
    return new $class_name;
  }
}
