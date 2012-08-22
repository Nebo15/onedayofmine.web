<?php
require_once(dirname(__FILE__) . '/../../setup.php');
if('production' == lmb_app_mode())
{
  echo "Can't test in production mode".PHP_EOL;
  exit(1);
}

lmb_env_set('LIMB_CONF_INCLUDE_PATH', 'tests/settings;settings');
lmb_env_set('LIMB_CACHE_DB_META_IN_FILE', false);

lmb_require('tests/src/odObjectMother.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmbToolkit :: merge(new odTestsTools());

lmbToolkit::instance()->checkServer(lmb_env_get('HOST_URL'));
lmbToolkit::instance()->getPostmanWriter()->deleteFile();
lmbToolkit::instance()->getApiToMarkdownWriter()->deleteFile();


