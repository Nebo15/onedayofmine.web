<?php

$base_path = lmb_env_get('APP_DIR').'/settings/db.conf.';
if(file_exists($base_path.'override.php'))
	include($base_path.'override.php');
else
	include($base_path.'php');

$conf['dsn'] = $conf['tests_dsn'];
