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
    $hash = md5($query);
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

    // Calculating hash
    $hash = 'call_'.md5(serialize($arguments));
    $hash_exception = $hash.'_exception';

    // If exception cached
    // if($this->cache->get($hash_exception))
    //   throw $this->cache->get($hash_exception);

    // If data cached
    if($cached_value = $this->cache->get($hash))
      return unserialize($cached_value);

    // Clone days and moments pages on remote host and replace data in request
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

    // Make request and cache exceptions
    $start_time = microtime(true);
    try {
      $result = call_user_func_array(array($this->provider, 'api'), array($path, $method, $params));
    } catch (Exception $e) {
      // Cache exceptions
      // $this->cache->set($hash_exception, serialize($e));

      // Log exceptions cache
      lmbToolkit::instance()
        ->getLog('test_request')
        ->info(get_class($this->provider).' real request with exception: ', array(
          'arguments' => $arguments,
          'time' => microtime(true) - $start_time,
        ));

      // Throw exception that should be catched by outer handler
      throw $e;
    }

    // Log uncached requests
    lmbToolkit::instance()
      ->getLog('test_request')
      ->info(get_class($this->provider).' real request: ', array('arguments' => $arguments, 'time' => microtime(true) - $start_time, 'result' => $result));

    // Save serialized data
    $this->cache->set($hash, serialize($result));

    return $result;
  }

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

  /**
   * @return Client
   */
  protected function _createProxyClient()
  {
    static $client;
    if(!$client)
      $client = new Client($this->proxy_host.'/proxy.php', lmbToolkit::instance()->getSiteUrl(''));
    return $client;
  }
}
