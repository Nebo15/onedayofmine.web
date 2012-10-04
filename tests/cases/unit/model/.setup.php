<?php
require_once(dirname(__FILE__) . '/../../common.inc.php');

require_once('limb/dbal/tests/cases/init.inc.php');
lmb_tests_init_db_dsn();

lmb_tests_setup_db(dirname(__FILE__) . '/.fixture/init_tests.');