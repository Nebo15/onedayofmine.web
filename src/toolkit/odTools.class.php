<?php
lmb_require('limb/toolkit/src/lmbAbstractTools.class.php');
lmb_require('src/service/social_provider/odFacebook.class.php');
lmb_require('src/service/social_provider/odTwitter.class.php');
lmb_require('src/service/social_profile/FacebookProfile.class.php');
lmb_require('src/service/social_profile/TwitterProfile.class.php');
lmb_require('src/service/odNewsService.class.php');
lmb_require('src/service/ImageHelper.class.php');
lmb_require('src/service/odPostingService.class.php');
lmb_require('src/service/odExportHelper.class.php');
lmb_require('src/service/odRequestsLog.class.php');
lmb_require('src/service/odAsyncJobs.class.php');
lmb_require('src/model/User.class.php');
require_once('amazon-sdk/sdk.class.php');

class odTools extends lmbAbstractTools
{
  /**
   * @var User Current logged in user.
   */
  protected $user;
  /**
   * @var odRequestsLog
   */
  protected $requests_log;

  protected $tests_users;
  /**
   * @var odPostingService
   */
  protected $posting_service;

  protected $facebook_instances = array();

  protected $twitter_instances = array();

  protected $facebook_profiles = array();

  protected $job_queue_client;

  /**
   * @var Zend_Mobile_Push_Apns
   */
  protected $apns;

  function setUser($user)
  {
    $this->user = $user;
    $this->getSessionStorage()->set($this->getSessidFromRequest(), $user->getId());
  }

  /**
   * @return User
   */
  function getUser()
  {
    if(null != $this->user)
      return $this->user;

    if(!$user_id = $this->getSessionStorage()->get($this->getSessidFromRequest()))
      return null;

    $this->user = User::findById($user_id);


    return $this->user;
  }

  function resetUser()
  {
    $this->user = null;
    $this->getSessionStorage()->delete($this->getSessidFromRequest());
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
   * @return odNewsService
   */
  function getNewsObserver()
  {
    static $news_observer;

    if(!$news_observer)
      $news_observer = new odNewsService($this->getUser());

    return $news_observer;
  }

  /**
   * @return odExportHelper
   */
  function getExportHelper()
  {
    return  new odExportHelper($this->getUser());
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
    if($token = $this->getTokenFromRequest())
      return sha1($token);
    else
      return null;
  }

  function getTokenFromRequest()
  {
    $request = $this->toolkit->getRequest();

    if($request->getPost('token'))
      return $request->getPost('token');
    elseif($request->getGet('token'))
      return $request->getGet('token');
    elseif($request->getCookie('token'))
      return $request->getCookie('token');
    else
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
    $str = str_replace('//', '/', $this->getSiteUrl($this->getPagePath($object)));
    return str_replace(':/', '://', $str);
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
        $user->setFacebookUid($value['id']);
        $user->setFacebookAccessToken($value['access_token']);
        $user->import($this->getFacebookProfile($user)->getInfo());
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
    $access_token = is_object($access_token_or_user) ? $access_token_or_user->getFacebookAccessToken() : $access_token_or_user;
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
    if(!array_key_exists($user->getFacebookAccessToken(), $this->facebook_profiles)) {
      $this->facebook_profiles[$user->getFacebookAccessToken()] = new FacebookProfile($user);
    }
    return $this->facebook_profiles[$user->getFacebookAccessToken()];
  }

  function setFacebookProfile(User $user, $profile)
  {
    $this->facebook_profiles[$user->getFacebookAccessToken()] = $profile;
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

  function setApns(Zend_Mobile_Push_Apns $apns)
  {
    $this->apns = $apns;
  }

  function getApns()
  {
    if(!$this->apns)
    {
      lmb_require('Zend/Mobile/Push/Apns.php');
      lmb_require('Zend/Mobile/Push/Message/Apns.php');
      $this->apns = new Zend_Mobile_Push_Apns();
    }
    return $this->apns;
  }

  function getSessionStorage()
  {
    if(lmbToolkit::instance()->getConf('cache')['cache_enabled'])
      return lmbToolkit::instance()->getCache('session');
    else
    {
      $session = lmbToolkit::instance()->getSession();
      if(!$session->isStarted())
        $session->start();
      return $session;
    }
  }

  function setJobQueueClient($client)
  {
    $this->job_queue_client = $client;
  }

  function getJobQueueClient()
  {
    if(!$this->job_queue_client)
    {
      $client = new GearmanClient();
      $client->addServer();
      $this->job_queue_client = $client;
    }
    return $this->job_queue_client;
  }

  function doAsync($function_name, $param1)
  {
    return $this->getJobQueueClient()
      ->doBackground($function_name, odAsyncJobs::encodeWorkload(array_slice(func_get_args(), 1)));
  }
}
