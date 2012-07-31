<?php
lmb_require('facebook/facebook.php');

class odFacebook extends Facebook implements odSocialServicesProviderInterface
{
  public static function getConfig()
  {
    return array(
      'appId'  => lmbToolkit::instance()->getConf('common')->get('fb_app_id'),
      'secret' => lmbToolkit::instance()->getConf('common')->get('fb_app_secret'),
      'cookie' => false
    );
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

  function validateAccessToken($error_list)
  {
    try
    {
      $this->api('/me');
      return true;
    }
    catch (Exception $e)
    {
      $error_list[] = $e->getMessage();
      return false;
    }
  }
}
