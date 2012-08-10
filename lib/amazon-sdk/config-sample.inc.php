<?php if (!class_exists('CFRuntime')) die('No direct access allowed.');

CFCredentials::set(array(
	'development' => array(
		'key' => 'AKIAJTFA7Z5XJAR2B65Q',
		'secret' => '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',
		'default_cache_config' => __DIR__.'/../../var/',
		'certificate_authority' => true
	),
	'@default' => 'development'
));
