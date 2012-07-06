<?php
lmb_require('tests/src/odPostmanWriter.class.php');
lmb_require('tests/src/odApiToMarkdownWriter.class.php');
lmb_require('tests/src/odCachedFacebook.class.php');

class odTestsTools extends lmbAbstractTools
{
	/**
	 * @var odPostmanWriter
	 */
	protected $postman_writer;

	/**
	 * @var odApiToMarkDownWriter
	 */
	protected $api_to_markdown_writer;

	function getPostmanWriter()
	{
		if(!$this->postman_writer)
			$this->postman_writer = new odPostmanWriter(lmb_env_get('APP_DIR').'/www/api_doc/postman.json');
		return $this->postman_writer;
	}

	/**
	 * @return odApiToMarkDownWriter
	 */
	function getApiToMarkdownWriter()
	{
		if(!$this->api_to_markdown_writer)
			$this->api_to_markdown_writer = new odApiToMarkdownWriter(lmb_env_get('APP_DIR').'/www/api_doc/examples.markdown');
		return $this->api_to_markdown_writer;
	}

	function getTestsUsers()
	{
		$users = array();
		foreach(lmbToolkit::instance()->loadTestsUsersInfo() as $user_info)
		{
			$user_info = (object) $user_info;
			$user = new User();
			$user->setFbUid($user_info->id);
			$user->setFbAccessToken($user_info->access_token);
			$user->import(FacebookUser::getUserInfo($user_info->access_token));
			$users[] = $user;
		}
		return $users;
	}

	function truncateTablesOf($model_classes)
	{
		if(!is_array($model_classes))
			$model_classes = func_get_args();
		foreach($model_classes as $model_class)
		{
			$model_class::delete();
		}
	}

	function checkServer($uri_string)
	{
		$uri = new lmbUri($uri_string);
		$fp = @fsockopen($uri->getHost(), $uri->getPort() ?: 80, $errno, $errstr, 30);
		if (!$fp) {
			echo("Can't connect to server '$uri_string': $errstr ($errno)\n");
			exit(1);
		} else {
			fclose($fp);
		}
	}

	function createFacebookConnection($access_token, $config)
	{
		return new odCachedFacebook(
				$config,
				lmbToolkit::instance()
				->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/facebook_cache/'.$access_token)
		);
	}
}


