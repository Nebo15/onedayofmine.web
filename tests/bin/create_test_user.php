#!/usr/bin/env php
<?php
require_once(dirname(__FILE__) . '/../../setup.php');

$app_id = lmbToolkit::instance()->getConf('facebook')->appId;

$response = lmbToolkit::instance()
            ->getFacebook()
            ->api("/$app_id/accounts/test-users?installed=true&permissions=publish_actions,user_location,user_birthday,email", 'POST');

var_dump($response);
