<?php
error_reporting(E_ALL | ~E_STRICT);

$app_dir = __DIR__;
$libs_dir = $app_dir . '/lib';

set_include_path(implode(PATH_SEPARATOR,
  array($app_dir, $libs_dir, get_include_path())
));

require_once('limb/core/common.inc.php');

if(file_exists(dirname(__FILE__) . '/setup.override.php'))
  require_once(dirname(__FILE__) . '/setup.override.php');

lmb_package_require('cms');
lmb_package_require('cache2');
lmb_package_require('profile');

lmb_env_setor('APP_DIR', $app_dir);
lmb_env_setor('LIBS_DIR', $libs_dir);
lmb_env_setor('LIMB_VAR_DIR', $app_dir . '/var/');
if(array_key_exists('SERVER_NAME', $_SERVER))
  lmb_env_setor('HOST_NAME', $_SERVER['SERVER_NAME']);
lmb_env_setor('LIMB_APP_MODE' , 'production');

lmb_require('src/model/*.class.php');

lmb_require('limb/toolkit/src/lmbToolkit.class.php');
lmb_require('src/toolkit/OneDayTools.class.php');
lmbToolkit :: merge(new OneDayTools());

lmb_env_set('SESSION_COOKIE_NAME', 'SESSID');
ini_set('session.name', lmb_env_get('SESSION_COOKIE_NAME'));
