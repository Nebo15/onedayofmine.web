<?php

abstract class BaseSocialPhotoSource
{
	/**
	 * @var User
	 */
	protected $user;
	protected $app_key;
	protected $app_secret;

	function __construct(User $user)
	{
		$this->user = $user;
		$conf = $this->getConfig();
		$this->app_key = $conf['key'];
		$this->app_secret = $conf['secret'];
	}

	abstract protected function getConfig();
	abstract function getLoginUrl($redirect_url);
	abstract function login($code, $redirect_url);
	abstract function getUserInfo();
	abstract function getPhotos($from_stamp, $to_stamp = null);
	abstract function getDays($from_stamp = null);
	abstract function logout();
}