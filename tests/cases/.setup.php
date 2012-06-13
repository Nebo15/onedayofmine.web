<?php
require_once(dirname(__FILE__) . '/../../setup.php');

lmb_env_set('LIMB_CONF_INCLUDE_PATH', 'tests/settings;settings');
lmb_env_set('LIMB_CACHE_DB_META_IN_FILE', false);
lmb_env_set('LIMB_VAR_DIR', dirname(__FILE__) . '/../var/');

lmb_require(__DIR__.'/odTestsTools.class.php');
lmb_require(__DIR__.'/odObjectMother.class.php');

