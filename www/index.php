<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

require_once(dirname(__FILE__) . '/../setup.php');
lmb_require('src/odApplication.class.php');
lmb_require('limb/cms/src/lmbCmsApplication.class.php');

if('/admin' === substr($_SERVER['REQUEST_URI'], 0, 6))
  $application = new lmbCmsApplication();
else
  $application = new odApplication();
$application->process();


