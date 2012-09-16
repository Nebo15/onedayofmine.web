<?php
require_once(dirname(__FILE__) . '/../../setup.php');
if('production' == lmb_app_mode())
{
  echo "Can't test in production mode".PHP_EOL;
  exit(1);
}
lmb_env_set('LIMB_CACHE_DB_META_IN_FILE', false);

lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmbToolkit :: merge(new odTestsTools());

$uniq_hostname_hash = (base_convert(substr(md5(gethostname()), 0, 6), 16, 10));
lmbToolkit::instance()->makeUniqueTablesIdsOffset($uniq_hostname_hash);
