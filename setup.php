<?php

set_include_path(implode(PATH_SEPARATOR,
  array(
    dirname(__FILE__) . '/lib/',
    dirname(__FILE__),
    get_include_path()
  )
));

require_once('limb/core/common.inc.php');

if(file_exists(dirname(__FILE__) . '/setup.override.php'))
  require_once(dirname(__FILE__) . '/setup.override.php');

lmb_package_require('cms');

lmb_env_setor('LIMB_VAR_DIR', dirname(__FILE__) . '/var/');
lmb_env_setor('LIMB_APP_MODE' , 'production');