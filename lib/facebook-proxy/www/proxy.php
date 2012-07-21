<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require_once(__DIR__.'/../src/Proxy.php');

$proxy = new Proxy(__DIR__.'/../www/objects', '/objects');
echo $proxy->process($_REQUEST);
