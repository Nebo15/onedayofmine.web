<?php
lmb_require('lib/tmhOAuth/tmhOAuth.php');
lmb_require('src/service/social_provider/SocialProviderInterface.class.php');
lmb_require('src/service/social_provider/odTwitterException.class.php');

class odTwitter extends tmhOAuth implements SocialProviderInterface
{
  public static function getConfig()
  {
    return (array) lmbToolkit::instance()->getConf('twitter');
  }

  function __construct(array $config = null)
  {
    if('cli' == php_sapi_name())
      session_id('CLI');
    parent::__construct($config ?: self::getConfig());
  }

  public function api($path, $method = self::METHOD_GET, $params = array())
  {
    $code = $this->request($method, $this->url($path), $params);

    $this->checkRateLimit();

    $response = json_decode($this->response['response'], true);

    if($this->response && $code == 200)
      return $response;
    elseif(is_array($response)) {
      if(array_key_exists('error', $response)) {
        throw new odTwitterException("Twitter API exception: {$response['error']}.", $response);
      }

      // elseif(array_key_exists('errors', $response)) {
      throw new odTwitterException("Unknown Twitter API exception.", $response);
      // }
    }

    return false;
  }

  public function makeQuery($query)
  {
    throw new lmbException("FQL is not available in Twitter API.");
  }

  public function getUid($error_list, $provider = null)
  {
    $provider = $provider ?: $this;
    try
    {
      return $provider->api('1/account/verify_credentials')['id'];
    }
    catch (Exception $e)
    {
      $error_list->addError($e->getMessage());
      return false;
    }
  }

  protected function checkRateLimit()
  {
    if(!array_key_exists('headers', $this->response))
      return;

    $headers = $this->response['headers'];
    if(array_key_exists('x_ratelimit_remaining', $headers) && $headers['x_ratelimit_remaining'] == 0) {
      $reset = $headers['x_ratelimit_reset'];
      $diff = time() - $reset;

      lmbToolkit::instance()
        ->getLog()
        ->error("Twitter rate limit exhausted. Reset time: '{$reset}' ('{$diff}').");
    }
  }

  function downloadImage($url)
  {
    return file_get_contents($url);
  }
}
