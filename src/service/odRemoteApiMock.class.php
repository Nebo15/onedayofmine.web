<?php
lmb_require('tests/src/odObjectMother.class.php');
lmb_require('facebook-proxy/src/Client.php');

class odRemoteApiMock
{
  /**
   * @var odSocialServicesProviderInterface
   */
  protected $provider;
  /**
   * @var lmbCacheAbstractConnection
   */
  protected $cache;
  /**
   * @var string
   */
  protected $proxy_host = 'http://stage.onedayofmine.com/';

  function __construct(odSocialServicesProviderInterface $provider, $cache)
  {
    $this->provider = $provider;
    $this->cache = $cache;
  }

  function __call($name, $arguments)
  {
    return call_user_func_array(array($this->provider, $name), $arguments);
  }

  function __get($name)
  {
    if(isset($this->provider->$name))
      return $this->provider->$name;
  }

  function makeQuery($query)
  {
    $hash = 'query_'.md5($query);
    if($cached_value = $this->cache->get($hash))
      return $cached_value;
    $result = $this->provider->makeQuery($query);
    $this->cache->set($hash, $result);
    return $result;
  }

  function api($path, $method = odSocialServicesProviderInterface::METHOD_GET, $params = array())
  {
    // Hash request with placeholder
    $arguments = array('path' => $path, 'method' => $method, 'params' => $params);
    array_walk_recursive($arguments, function(&$item) {
      if(is_string($item))
        $item = preg_replace('#/[0-9]{2,}/#is', '/:id/', $item);
    });
    $hash = 'call_'.md5(serialize($arguments));

    $arguments = array('path' => $path, 'method' => $method, 'params' => $params);
    if($cached_value = $this->cache->get($hash))
    {
      return unserialize($cached_value);
    }

    array_walk_recursive($params, function(&$item) use($arguments) {
      if(is_string($item)) {
        preg_match('#^(.*)(/pages/([0-9]*)/(day|moment))$#is', $item, $out);
        if(count($out)) {
          $host = $out[1];
          $path = $out[2];
          $item = str_replace("{$host}/", $this->proxy_host, $item);
          $this->_createProxyClient()->copyObjectPageToProxy($path);

          lmbToolkit::instance()
            ->getLog('test_request')
            ->info(get_class($this->provider).' clone object request: ', array('found' => $out, 'item' => $item, 'args' => $arguments));
        }
      }
    });

    $start_time = microtime(true);
    try {
      $result = call_user_func_array(array($this->provider, 'api'), array($path, $method, $params));
    } catch (Exception $e) {
      $result = false;
    }
    $delta = microtime(true) - $start_time;

    lmbToolkit::instance()
      ->getLog('test_request')
      ->info(get_class($this->provider).' real request: ', array('arguments' => $arguments, 'time' => $delta, 'result' => $result));

    $this->cache->set($hash, serialize($result));

    throw $e;

    return $result;
  }

  /**
   * Функция идёт в odRemoteApi, потом переадресовывается в odFacebook тк нет кеша, там происходит исключение, которой не даёт методу api закешировать данные,
   * останавливая обработку на 59 строке.
   */
  function getUid($error_list)
  {
    return $this->provider->getUid($error_list, $this);
  }

  function downloadImage($url)
  {
    $hash = 'img_'.md5($url);

    if(!$this->cache->get($hash))
      $this->cache->set($hash, file_get_contents($url));

    return $this->cache->get($hash);
  }

  function isFileExists($url)
  {
    $hash = 'isfile_'.md5($url);

    if(!$this->cache->get($hash))
      $this->cache->set($hash, (bool) @fopen($url, "r"));

    return $this->cache->get($hash);
  }

  /**
   * @return Client
   */
  protected function _createProxyClient()
  {
    // static $client;
    // if(!$client)
      return new Client($this->proxy_host.'/proxy.php', lmbToolkit::instance()->getSiteUrl(''));
    // return $client;
  }
}
