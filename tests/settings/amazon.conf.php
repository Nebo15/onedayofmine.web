<?php
require_once('settings/amazon.conf.php');
if(file_exists('settings/amazon.conf.override.php'))
  require_once('settings/amazon.conf.override.php');

$conf['S3']['enabled'] = false;
