#!/usr/bin/php
<?php
require_once(dirname(__FILE__) . '/../lib/limb/tests_runner/src/lmbTestShellUI.class.php');

set_time_limit(0);
error_reporting(E_ALL);

$ui = new lmbTestShellUI();
$ui->run();
