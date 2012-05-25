<?php
lmb_require('core/src/exception/lmbException.class.php');

class lmbPackagesFunctionsTest extends UnitTestCase
{
  public static $counter = 0;
  protected $_prev_env = array();

  function setUp()
  {
    $this->_prev_env = $_ENV;
    $_ENV = array();

    self::$counter = 0;

    $packages_dir = lmb_var_dir() . 'core_packages_test/';
    if(!file_exists($packages_dir))
      mkdir($packages_dir);
    lmb_env_set('LIMB_PACKAGES_DIR', $packages_dir);
  }

  function tearDown()
  {
    $_ENV = $this->_prev_env;
  }

  protected function createPackageMainFile($name, $packages_dir)
  {
    if(!file_exists($packages_dir . $name))
      mkdir($packages_dir . $name);

    $path = $packages_dir . $name . '/common.inc.php';
    $content = '<?php lmbPackagesFunctionsTest::$counter++; lmb_package_register("'.$name.'", dirname(__FILE__)); ?>';
    file_put_contents($path, $content);
  }

  function testPackageInclude()
  {
    $this->createPackageMainFile('include', lmb_env_get('LIMB_PACKAGES_DIR'));
    lmb_package_require('include');
    $this->assertIdentical(1, lmbPackagesFunctionsTest::$counter);
  }

  function testPackageInclude_NotExistedPackage()
  {
    lmbErrorGuard::registerErrorHandler('lmbErrorGuard', 'convertErrorsToExceptions');
    try {
      lmb_package_require($name = 'not_existed', $package_dir = 'darkside/');
      $this->fail();
    } catch (lmbNoSuchPackageException $e) {
      $this->assertEqual($package_dir, $e->getParam('dir'));
      $this->assertEqual($name, $e->getParam('name'));
    }

    restore_error_handler();
  }

  function testPackageInclude_CustomPath()
  {
    $this->createPackageMainFile('include_custom', lmb_var_dir());
    lmb_package_require('include_custom', lmb_var_dir());
    $this->assertTrue(lmb_package_registered('include_custom'));
    $this->assertTrue(lmb_Var_dir() . '/include_custom', lmb_package_get_path('include_custom'));
    $this->assertIdentical(1, lmbPackagesFunctionsTest::$counter);
  }

  function testPackageRegisterAndRegistered()
  {
    $this->assertFalse(lmb_package_registered('foo'));
    lmb_package_register('foo', lmb_env_get('LIMB_PACKAGES_DIR'));
    $this->assertTrue(lmb_package_registered('foo'));
  }

  function testPackageInclude_ManyTimes()
  {
    $this->createPackageMainFile('include_many', lmb_env_get('LIMB_PACKAGES_DIR'));

    lmb_package_require('include_many', lmb_env_get('LIMB_PACKAGES_DIR'));
    lmb_package_require('include_many', lmb_env_get('LIMB_PACKAGES_DIR'));

    $this->assertIdentical(1, lmbPackagesFunctionsTest::$counter);
  }

  function testPackagesList()
  {
    $this->assertEqual(array(), lmb_packages_list());

    lmb_package_register('package1', 'dir1');
    lmb_package_register('package2', 'dir2');            

    $this->assertEqual(array('package1' => 'dir1', 'package2' => 'dir2'), lmb_packages_list());
        
    lmb_package_register('package1', 'dir/dir1');
    lmb_package_register('package2', 'dir/dir2');
    lmb_package_register('package3', 'dir3');
    
    $this->assertEqual(array('package1' => 'dir/dir1', 'package2' => 'dir/dir2'), lmb_packages_list('dir/'));
  }

  function testPackagePath()
  {
    lmb_package_register('foo', '/bar/');
    $this->assertEqual('/bar', lmb_package_get_path('foo'));
  }

  function testRequirePackageClass()
  {
    $package_name = 'require_package_source';
    $package_source_dir = lmb_env_get('LIMB_PACKAGES_DIR').'/'.$package_name.'/src/';
    $package_class = 'SourceFileForTests';

    $this->createPackageMainFile($package_name, lmb_env_get('LIMB_PACKAGES_DIR'));
    if(!file_exists($package_source_dir))
      mkdir($package_source_dir);
    $source_file_content =<<<EOD
<?php
class $package_class {
  static function increase() {
    lmbPackagesFunctionsTest::\$counter++;
  }
}
EOD;
    file_put_contents($package_source_dir.'/'.$package_class.'.class.php', $source_file_content);

    $this->assertIdentical(0, lmbPackagesFunctionsTest::$counter);

    lmb_package_require($package_name);
    $this->assertIdentical(1, lmbPackagesFunctionsTest::$counter);

    lmb_require_package_class($package_name, 'SourceFileForTests');
    call_user_func(array($package_class, 'increase'));
    $this->assertIdentical(2, lmbPackagesFunctionsTest::$counter);
  }
}
