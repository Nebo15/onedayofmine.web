<?php
lmb_require('lib/tmhOAuth/*.php');

class odTwitter extends tmhOAuth implements odSocialServicesProviderInterface
{
  public static function getConfig()
  {
    return array(
      'consumer_key'    => lmbToolkit::instance()->getConf('twitter')->twitter_consumer_key,
      'consumer_secret' => lmbToolkit::instance()->getConf('twitter')->twitter_consumer_secret,
    );
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
    elseif(isset($response['error'])) // Rate limit errors
      lmbToolkit::instance()
        ->getLog()
        ->error("Twitter returned error: '{$response['error']}'.", array($path, $method, $params));
    elseif(isset($response['errors'])) // Basic errors
      lmbToolkit::instance()
        ->getLog()
        ->error("Twitter returned with errors.", array($response['errors'], array($path, $method, $params)));

    return false;
  }

  public function makeQuery($query)
  {
    throw new lmbException("FQL is not available in Twitter API.");
  }

  public function validateAccessToken($error_list, $provider = null)
  {
    $provider = $provider ?: $this;
    if($provider->api('1/account/verify_credentials')) {
      return true;
    } else {
      $error_list->addError("Access token seems to be unvalid.");
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
}
