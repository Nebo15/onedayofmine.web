<?php
lmb_require('facebook/facebook.php');
lmb_require('src/service/social_provider/odSocialServicesProviderInterface.class.php');

class odFacebook extends Facebook implements odSocialServicesProviderInterface
{
  public static function getConfig()
  {
    return (array) lmbToolkit::instance()->getConf('facebook');
  }

  function __construct(array $config = null)
  {
    if('cli' == php_sapi_name())
      session_id('CLI');
    parent::__construct($config ?: self::getConfig());
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
    catch (Exception $e)
    {
      $error_list[] = $e->getMessage();
      return false;
    }
  }

  function downloadImage($url)
  {
    return file_get_contents($url);
  }
}
