#!/usr/bin/env php
<?php
require_once(dirname(__FILE__) . '/../../setup.php');

$app_id = lmbToolkit::instance()->getConf('common')->facebook_app_id;
$app_access_token = lmbToolkit::instance()->getConf('common')->facebook_app_secret;

$remote_api_cache_enabled = lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled;
lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled = false;

$response = lmbToolkit::instance()
            ->getFacebook()
            ->api("/$app_id/accounts/test-users?installed=true&permissions=publish_actions,user_location,user_birthday,email", 'POST');

lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled = $remote_api_cache_enabled;

var_dump($response);
