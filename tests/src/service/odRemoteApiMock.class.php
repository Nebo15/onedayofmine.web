<?php
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
    $hash = md5(serialize($arguments));

    $arguments = array('path' => $path, 'method' => $method, 'params' => $params);
    if($cached_value = $this->cache->get($hash))
    {
      // lmbToolkit::instance()
      //   ->getLog('test_request')
      //   ->debug(get_class($this->provider).' fake request: ', array('arguments' => $arguments, 'result' => $cached_value));
      return $cached_value;
    }

    $start_time = microtime(true);
    $result = call_user_func_array(array($this->provider, 'api'), func_get_args());
    $delta = microtime(true) - $start_time;

    lmbToolkit::instance()
      ->getLog('test_request')
      ->debug(get_class($this->provider).' real request: ', array('arguments' => $arguments, 'time' => $delta, 'result' => $result));

    $this->cache->set($hash, $result);
    return $result;
  }

  /**
   * Функция идёт в odRemoteApi, потом переадресовывается в odFacebook тк нет кеша, там происходит исключение, которой не даёт методу api закешировать данные,
   * останавливая обработку на 59 строке.
   */
  function validateAccessToken($error_list)
  {
    return $this->provider->validateAccessToken($error_list, $this);
  }

  function downloadImage($url)
  {
    return (new odObjectMother())->image();
  }
}
