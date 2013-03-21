<?php

$conf = array(
  'debug_enabled' => lmb_env_get('LIMB_APP_MODE') === 'devel',
  'default_news_count' => 100,
  'default_comments_count' => 3,
  'static_host' => 'http://onedayofmine.s3.amazonaws.com/',
  'requests_log_enabled' => false,
	'async_enabled' => true,

	'instagram' => [
		'key' => 'd6a604d51f5a495e96f88048b98c6e22',
		'secret' => 'f18896e462fb4149ab776edd56e6bbb8'
	],

	'flickr' => [
		'key' => '7779fdde3c7525e0015d46694b6839d1',
		'secret' => 'bdf98eeeba525020'
	]
);
