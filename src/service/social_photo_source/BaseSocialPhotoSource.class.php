<?php
lmb_require('src/service/social_photo_source/BasePhotoSource.class.php');

abstract class BaseSocialPhotoSource extends  BasePhotoSource
{
	const LIMIT = 40;
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

	abstract function logout();
}