<?php

class odCachedFacebook
{
	/**
	 * @var odFacebook
	 */
	protected $original;
	/**
	 * @var lmbCacheAbstractConnection
	 */
	protected $cache;

	function __construct($config, $cache)
	{
		$this->original = new odFacebook($config);
		$this->cache = $cache;
	}

	function __call($name, $arguments)
	{
		return call_user_func_array(array($this->original, $name), $arguments);
	}

	function makeQuery($query)
	{
		$hash = md5($query);
		if($cached_value = $this->cache->get($hash))
			return $cached_value;
		$result = $this->original->makeQuery($query);
		$this->cache->set($hash, $result);
		return $result;
	}

	function api($arguments)
	{
		$arguments = func_get_args();
		$hash = md5(serialize($arguments));
		if($cached_value = $this->cache->get($hash))
		{
// 			lmbToolkit::instance()
// 			->getLog()
// 			->info('Facebook cache request: ', array('arguments' => $arguments));
			return $cached_value;
		}
		$start_time = microtime(true);
		$result = call_user_func_array(array($this->original, 'api'), $arguments);
		$delta = microtime(true) - $start_time;
		lmbToolkit::instance()
			->getLog()
			->error('Facebook real request: ', array('arguments' => $arguments, 'time' => $delta, 'result' => $result));
		$this->cache->set($hash, $result);
		return $result;
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