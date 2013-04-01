<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/core/src/lmbErrorGuard.class.php');

class lmbErrorGuardTest extends UnitTestCase
{
//  function setUp()
//  {
//    lmbErrorGuard::registerErrorHandler('lmbErrorGuard', 'convertErrorsToExceptions');
//  }
//
//  function tearDown()
//  {
//    restore_error_handler();
//  }
//
//  function testConvertingErrorsToExceptions()
//  {
//    try {
//      strpos();
//      $this->fail('Warning should be converted to an Exception');
//    } catch(lmbException $e) {
//      $this->pass();
//    }
//  }
//
//  function testDisabledErrorReportingDoesNotThrowExceptionOnError()
//  {
//    $old_reporting = error_reporting();
//    error_reporting(0);
//
//    try {
//      strpos();
//    } catch(lmbException $e) {
//      $this->fail('No converted from error exception expected!');
//    }
//
//    error_reporting($old_reporting);
//  }

  function testRegisterExceptionHandler()
  {
    $test_content = <<<EOD
set_exception_handler(null);

function onException1(Exception \$e) { echo \$e->getMessage();}
lmbErrorGuard::registerExceptionHandler('onException1');

throw new Exception('foo');
EOD;
    $output = $this->_runOnCleanEnv($test_content);
    $this->assertEqual('foo', $output);
  }

  function testRegisterExceptionHandler_MultipleHandlers()
  {
    $test_content = <<<EOD
set_exception_handler(null);

function onException1(Exception \$e) { echo \$e->getMessage();}
function onException2(Exception \$e) { echo \$e->getMessage();}
lmbErrorGuard::registerExceptionHandler('onException1');
lmbErrorGuard::registerExceptionHandler('onException2');

throw new Exception('foo');
EOD;
    $output = $this->_runOnCleanEnv($test_content);
    $this->assertEqual('foofoo', $output);
  }

  function _runOnCleanEnv($code)
  {
    $tmp_file = lmbFs::generateTmpFile();
    $lib_dir = realpath(dirname(__FILE__).'/../../../../');
    $tester_header = <<<EOD
<?php
set_include_path('$lib_dir');
require_once('limb/core/common.inc.php');
EOD;

    file_put_contents($tmp_file, $tester_header.$code);
    exec('php '.$tmp_file, $out);
    return implode(PHP_EOL, $out);
  }
}

class lmbHandlerForErrorGuardTest
{
  static public $e;

  static function exception(Exception $e)
  {
    self::$e = $e;
    return null;
  }
}
