<?php
if (extension_loaded('newrelic'))
	newrelic_start_transaction();

require_once(dirname(__FILE__) . '/../setup.php');
lmb_require('src/odApplication.class.php');
lmb_require('limb/cms/src/lmbCmsApplication.class.php');

if('/admin' === substr($_SERVER['REQUEST_URI'], 0, 6) || '/cms' === substr($_SERVER['REQUEST_URI'], 0, 4))
  $application = new lmbCmsApplication();
else
  $application = new odApplication();
$application->process();

if (extension_loaded('newrelic'))
	newrelic_end_of_transaction();
