<?php

$conf = array(
  'debug_enabled' => lmb_env_get('LIMB_APP_MODE') === 'devel',
  'default_news_count' => 100,
  'default_comments_count' => 3,
  'static_host' => 'http://onedayofmine.s3.amazonaws.com/',
  'requests_log_enabled' => false,
	'async_enabled' => true,

	'instagram' => [
		'client_id' => '8d8b1d3774bd4767ba54b6f48b647b9a',
		'client_secret' => '3aaf3029cb40488f9a2adc2a5a9a1443',
		'redirect_url' => lmb_env_get('HOST_URL').'/pages/import'
	],
);
