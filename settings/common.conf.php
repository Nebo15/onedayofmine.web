<?php

$conf = array(
  'debug_enabled' => lmb_env_get('LIMB_APP_MODE') === 'devel',
  'default_news_count' => 100,
  'default_comments_count' => 3,
  'static_host' => 'http://onedayofmine.s3.amazonaws.com/',
  'requests_log_enabled' => false,
	'async_enabled' => true,
);
