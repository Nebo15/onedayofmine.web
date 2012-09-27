<?php
lmb_require('facebook/base_facebook.php');
lmb_require('src/service/social_provider/odSocialServicesProviderInterface.class.php');
lmb_require('src/service/social_provider/odFacebookApiExpiredTokenException.class.php');

class odFacebook extends BaseFacebook implements odSocialServicesProviderInterface
{
  protected $storage;
  protected $supported_keys = ['state', 'code', 'access_token', 'user_id'];

  public static function getConfig()
  {
    return (array) lmbToolkit::instance()->getConf('facebook');
  }

  function __construct(array $config = null)
  {
    parent::__construct($config ?: self::getConfig());
  }

  protected function setPersistentData($key, $value) {
    if (!in_array($key, $this->supported_keys)) {
      self::errorLog('Unsupported key passed to setPersistentData.');
      return;
    }

    lmbToolkit::instance()->getSessionStorage()->set($this->constructSessionVariableName($key), $value);
  }

  protected function getPersistentData($key, $default = false) {
    if (!in_array($key, $this->supported_keys)) {
      self::errorLog('Unsupported key passed to getPersistentData.');
      return $default;
    }

    return lmbToolkit::instance()->getSessionStorage()->get($this->constructSessionVariableName($key)) ?: $default;
  }

  protected function clearPersistentData($key) {
    if (!in_array($key, $this->supported_keys)) {
      self::errorLog('Unsupported key passed to clearPersistentData.');
      return;
    }

    lmbToolkit::instance()->getSessionStorage()->delete($this->constructSessionVariableName($key));
  }

  protected function clearAllPersistentData() {
    foreach ($this->supported_keys as $key) {
      $this->clearPersistentData($key);
    }
  }

  protected function constructSessionVariableName($key) {
    return implode('_', array('fb', $this->getAppId(), $key));
  }

  function makeQuery($query)
  {
    return $this->api(
      array('method' => 'fql.query', 'query' => $query)
    );
  }

  public function getUid($error_list, $provider = null)
  {
    $provider = $provider ?: $this;
    try
    {
      return $provider->api('/me')['id'];
    }
    catch(odFacebookApiExpiredTokenException $e)
    {
      $error_list[] = 'Token expired';
      return false;
    }
    catch (FacebookApiException $e)
    {
      $error_list[] = $e->getMessage();
      return false;
    }
  }

  function downloadImage($url)
  {
    return file_get_contents($url);
  }

  protected function throwAPIException($result)
  {
    if(array_key_exists('error', $result) && array_key_exists('message', $result['error']))
    {
      $message = $result['error']['message'];

      if(false !== strpos($message, 'Error validating access token'))
        throw new odFacebookApiExpiredTokenException($message);
    }

    parent::throwAPIException($result);
  }
}
