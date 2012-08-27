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

  protected $tests_users;
  /**
   * @var odPostingService
   */
  protected $posting_service;

  protected $facebook_instances = array();

  protected $twitter_instances = array();

  protected $facebook_profiles = array();

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
  function getPostingService()
  {
    if(!$this->posting_service)
      $this->posting_service = new odPostingService();

    return $this->posting_service;
  }

  function setPostingService($posting_service)
  {
    $this->posting_service = $posting_service;
  }

  /**
   * @return odNewsObserver
   */
  function getNewsObserver()
  {
    static $news_observer;

    if(!$news_observer)
      $news_observer = new odNewsObserver($this->getUser());

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

    return $this->toolkit->getConf('common')['static_host'].$path;
  }

  function getPagePath($object)
  {
    if(!$object->getId())
      throw new lmbException("Can't get object ID.");

    if('Day' == get_class($object))
      return '/pages/'.$object->getId().'/day';
    if('Moment' == get_class($object))
      return '/pages/'.$object->getId().'/moment';
    throw new lmbException('Unknown object class');
  }

  function getPageUrl($object)
  {
    return str_replace('//', '/', $this->getSiteUrl($this->getPagePath($object)));
  }

  function getAbsolutePath($www_path)
  {
    return lmb_env_get('APP_DIR')."/www/".$www_path;
  }

  function loadTestsUsersInfo()
  {
    if(!$this->tests_users)
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
      $this->tests_users = $users['data'];
    }
    return $this->tests_users;
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
    if(!array_key_exists($access_token, $this->twitter_instances)) {
      $config = odTwitter::getConfig();

      if(!is_null($access_token) && !is_null($access_token_secret)) {
        $config['user_token']  = $access_token;
        $config['user_secret'] = $access_token_secret;
      }

      $this->twitter_instances[$access_token] = new odTwitter($config);
    }

    return $this->twitter_instances[$access_token];
  }

  function setTwitter($twitter, $access_token = null)
  {
    $this->twitter_instances[$access_token] = $twitter;
  }

  /**
   * Create odFacebook instance with or without auth.
   *
   * @param  string $access_token
   * @return odFacebook
   */
  public function getFacebook($access_token_or_user = null)
  {
    $access_token = is_object($access_token_or_user) ? $access_token_or_user->getFbAccessToken() : $access_token_or_user;
    if(!array_key_exists($access_token, $this->facebook_instances)) {
      $instance = new odFacebook(odFacebook::getConfig());

      if(!is_null($access_token))
        $instance->setAccessToken($access_token);

      $this->facebook_instances[$access_token] = $instance;
    }

    return $this->facebook_instances[$access_token];
  }

  public function setFacebook($facebook, $access_token = null)
  {
    $this->facebook_instances[$access_token] = $facebook;
  }

  public function getFacebookProfile(User $user)
  {
    if(!array_key_exists($user->getFbAccessToken(), $this->facebook_profiles)) {
      $this->facebook_profiles[$user->getFbAccessToken()] = new FacebookProfile($user);
    }
    return $this->facebook_profiles[$user->getFbAccessToken()];
  }

  function setFacebookProfile(User $user, $profile)
  {
    $this->facebook_profiles[$user->getFbAccessToken()] = $profile;
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
