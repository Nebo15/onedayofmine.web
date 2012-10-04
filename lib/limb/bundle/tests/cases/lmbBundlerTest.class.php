<?php

require_once(dirname(__FILE__) . '/../../src/lmbBundler.class.php');

class lmbBundlerTest extends UnitTestCase
{
  var $fixture_dir;

  function __construct()
  {
    $this->fixture_dir = realpath(dirname(__FILE__).'/../fixture') . DIRECTORY_SEPARATOR;
  }

  function testGetDependenciesFromFileSource()
  {
    $file_content = <<<EOD
<?php
  require    ('./require.php');
require_once('require_once.php');
lmb_require('lmb_require.php');
' bundler!';
?>
EOD;
    $deps = lmbBundler::getDependenciesFromFileSource($file_content);
    $this->assertEqual(3, count($deps));
    $this->assertTrue('./hello.php', $deps[0]);
    $this->assertTrue('world.php', $deps[1]);
    $this->assertTrue('from.php', $deps[2]);
  }

  function testGetDependenciesFromFile_WithoutComments()
  {
    $file_content = <<<EOD
<?php
/**
 * require('block_comment.php');
 */
//require('inline_comment.php');
EOD;
    $deps = lmbBundler::getDependenciesFromFileSource($file_content);
    $this->assertEqual(0, count($deps));
  }

  function testGetNewDependencies_PackageRequire()
  {
    $file_content = <<<EOD
 <?php
lmb_package_require('some_package');
EOD;
    $deps = lmbBundler::getDependenciesFromFileSource($file_content);
    $this->assertEqual(array('limb/some_package/common.inc.php'), $deps);
  }

  function testGetNewDependencies_emptyIncludesList()
  {
    $file = $this->fixture_dir . 'second-level.php';

    $bundler = new lmbBundler($include_path = $this->fixture_dir . PATH_SEPARATOR);
    $bundler->add($file);
    $includes = $bundler->getIncludes();

    $this->assertEqual(5, count($includes));
    $this->assertTrue(strpos($includes[0], 'hello.php'));
    $this->assertTrue(false !== strpos($includes[0], $this->fixture_dir));
    $this->assertTrue(strpos($includes[1], 'world.php'));
    $this->assertTrue(false !== strpos($includes[1], $this->fixture_dir));
    $this->assertTrue(strpos($includes[2], 'from.php'));
    $this->assertTrue(false !== strpos($includes[2], $this->fixture_dir));
    $this->assertTrue(strpos($includes[3], 'first-level.php'));
    $this->assertTrue(false !== strpos($includes[3], $this->fixture_dir));
    $this->assertTrue(strpos($includes[4], 'second-level.php'));
    $this->assertTrue(false !== strpos($includes[4], $this->fixture_dir));
  }

  function testGetNewDependencies_filledIncludesList()
  {
    $file = $this->fixture_dir . 'second-level.php';

    $bundler = new lmbBundler($include_path = $this->fixture_dir . PATH_SEPARATOR);

    $bundler->add($file);
    $includes1 = $bundler->getIncludes();

    $bundler->add($file);
    $includes2 = $bundler->getIncludes();

    $this->assertIdentical($includes1, $includes2);
  }

  function testGetNewDependencies_properlyResolveIncludePaths_findInFirstIncludePaths()
  {
    $fixture_sub_folder = $this->fixture_dir . 'subfolder/';

    $bundler = new lmbBundler($include_path = $this->fixture_dir . PATH_SEPARATOR . $fixture_sub_folder);

    $file = $this->fixture_dir . 'first-level.php';

    $bundler->add($file);
    $includes = $bundler->getIncludes();

    $this->assertEqual(4, count($includes));
    $this->assertEqual(realpath($includes[0]), realpath($this->fixture_dir . 'hello.php'));
    $this->assertTrue(false === strpos($includes[0], $fixture_sub_folder));
  }

  function testGetNewDependencies_properlyResolveIncludePaths_findNotInFirstIncludePath()
  {
    $fixture_sub_folder = realpath($this->fixture_dir . '/subfolder') . DIRECTORY_SEPARATOR;

    $bundler = new lmbBundler($include_path = $this->fixture_dir . PATH_SEPARATOR . $fixture_sub_folder);
    $bundler->add($this->fixture_dir . 'sub_folder_depended.php');
    $includes = $bundler->getIncludes();

    $this->assertEqual(2, count($includes));
    $this->assertEqual(realpath($includes[0]), $fixture_sub_folder . 'sub_folder.php');
    $this->assertTrue(false !== strpos($includes[0], $fixture_sub_folder));
  }

  function testGetIncludes_PathPrefix()
  {
    $include_paths = ($this->fixture_dir . PATH_SEPARATOR . $this->fixture_dir.'/path_prefix');
    $bundler = new lmbBundler($include_paths);
    $bundler->add($this->fixture_dir . '/path_prefix/common.inc.php');
    $this->assertEqual(
      array($this->fixture_dir.'path_prefix/foo.php'),
      $bundler->getIncludes($this->fixture_dir.'path_prefix')
    );
  }

  function testCleanUpFile()
  {
    $cleaned = lmbBundler::cleanUpFile($this->fixture_dir . 'first-level.php');
    $this->assertIdentical("' bundler!';", trim($cleaned));
  }

  function testMakeBundle()
  {
    $bundler = new lmbBundler($include_path = $this->fixture_dir . PATH_SEPARATOR);
    $bundler->add($this->fixture_dir . 'first-level.php');

    $content = $bundler->makeBundle($without_tags = true);
    $this->assertIdentical(str_replace(PHP_EOL, '', trim($content)), "'hello';' world';' from';' bundler!';");
  }
}

