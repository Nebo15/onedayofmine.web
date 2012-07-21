<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require_once(__DIR__.'/../src/Proxy.php');

$proxy = new Proxy(dirname($_SERVER['SCRIPT_FILENAME']));
echo $proxy->process($_REQUEST);
