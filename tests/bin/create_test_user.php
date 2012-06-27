#!/usr/bin/env php
<?php
require_once(dirname(__FILE__) . '/../../setup.php');

$app_id = lmbToolkit::instance()->getConf('common')->fb_app_id;
$app_access_token = lmbToolkit::instance()->getConf('common')->fb_app_secret;


$response = lmbToolkit::instance()
            ->getAppFacebook()
            ->api("/$app_id/accounts/test-users?installed=true&permissions=publish_actions", 'POST');

var_dump($response);
