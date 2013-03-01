<?php

$conf = array(
  'debug_enabled' => lmb_env_get('LIMB_APP_MODE') === 'devel',
  'default_news_count' => 100,
  'default_comments_count' => 3,
  'static_host' => 'http://onedayofmine.s3.amazonaws.com/',
  'requests_log_enabled' => false,
	'async_enabled' => true,

	'instagram' => [
		'key' => '8d8b1d3774bd4767ba54b6f48b647b9a',
		'secret' => '3aaf3029cb40488f9a2adc2a5a9a1443'
	],

	'flickr' => [
		'key' => '7779fdde3c7525e0015d46694b6839d1',
		'secret' => 'bdf98eeeba525020'
	]
);
