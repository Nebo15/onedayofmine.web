<?php
$conf = array(
  'options' => array(
    'key' => 'AKIAJVNSJIAS7VMCC4DA',
    'secret' => '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',
    'default_cache_config' => __DIR__.'/../../var/',
    'certificate_authority' => true),
  'S3' => array(
    'bucket' => 'onedayofmine',
    'enabled' => true
  ),
	'SNS' => [
		'enabled' => true,
		'topics' => [
			'alert@onedayofmine.com' => 'arn:aws:sns:us-east-1:361985507382:Critical'
		]
	]
);
