<?php

$conf = array(
  'debug_enabled' => lmb_env_get('LIMB_APP_MODE') === 'devel',
  'default_news_count' => 100,
  'default_comments_count' => 3,
  'default_likes_count' => 10,
  'static_host' => 'http://onedayofmine.s3.amazonaws.com/',
  'requests_log_enabled' => false,
	'async_enabled' => true,
	'notify_by_facebook' => true,
	'notify_by_facebook_og' => true,

	'instagram' => [
		'key' => 'd6a604d51f5a495e96f88048b98c6e22',
		'secret' => 'f18896e462fb4149ab776edd56e6bbb8'
	],

	'flickr' => [
		'key' => 'e33d877e38bfc9bf86e570fdb80b0dab',
		'secret' => 'ae3f39047c2951f4'
	]
);
