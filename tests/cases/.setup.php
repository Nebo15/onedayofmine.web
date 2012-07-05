<?php
require_once(dirname(__FILE__) . '/../../setup.php');

lmb_env_set('LIMB_CONF_INCLUDE_PATH', 'tests/settings;settings');
lmb_env_set('LIMB_CACHE_DB_META_IN_FILE', false);
lmb_env_set('LIMB_VAR_DIR', dirname(__FILE__) . '/../var/');

lmb_require('tests/src/odObjectMother.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmbToolkit :: merge(new odTestsTools());

lmbToolkit::instance()->checkServer(lmb_env_get('HOST_NAME'));
lmbToolkit::instance()->getPostmanWriter()->deleteFile();
lmbToolkit::instance()->getApiToMarkdownWriter()->deleteFile();


