<?php
lmb_require('limb/fs/src/lmbFs.class.php');
lmb_require('limb/fs/src/exception/lmbFileNotFoundException.class.php');
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/ImageHelper.class.php');

class ImageHelperTest //extends odUnitTestCase
{
  protected $image_with_gps_info;
  protected $image_without_gps_info;

  function setUp()
  {
    parent::setUp();
    $this->image_with_gps_info = lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg';
    $this->image_without_gps_info = lmb_env_get('APP_DIR').'/tests/init/image_800x800.jpg';
  }

  function checkExif()
  {
    $helper = lmbToolkit::instance()->getImageHelper();
    $exif = $helper->getExifInfo($this->image_with_gps_info);

    $this->assertTrue($exif);
    $this->assertTrue(array_key_exists('FILE', $exif));
    $this->assertTrue(array_key_exists('FileDateTime', $exif['FILE']));
  }

  function testExif_fileNotExists()
  {
    $this->expectException('lmbFileNotFoundException');
    $helper = lmbToolkit::instance()->getImageHelper();
    $helper->getExifInfo('not_existent_pic.jpg');
  }

  function testExif_fileTime()
  {
    $helper = lmbToolkit::instance()->getImageHelper();
    $tmp_file = lmbFs::generateTmpFile('image_without_exif');
    file_put_contents($tmp_file, $this->generator->image());
    $exif = $helper->getExifInfo($tmp_file);
    $this->assertEqual($exif['FILE']['FileDateTime'], filemtime($tmp_file));
    lmbFs::rm($tmp_file);
  }

  function testExif_withoutGPSData()
  {
    $helper = lmbToolkit::instance()->getImageHelper();
    $exif = $helper->getExifInfo($this->image_without_gps_info);
    $this->assertFalse(array_key_exists('GPS', $exif));
  }

  function testExifGPSToCords()
  {
    $exif = lmbToolkit::instance()->getImageHelper()->getExifInfo($this->image_with_gps_info);
    $helper = lmbToolkit::instance()->getImageHelper();
    $basic_cords = $helper->exifGPSToCords($exif);

    $this->assertTrue(array_key_exists('GPS', $exif));

    $this->assertTrue(array_key_exists('latitude', $basic_cords));
    $this->assertTrue(array_key_exists('longitude', $basic_cords));

    $this->assertEqual(count($basic_cords['latitude']), 3);
    $this->assertEqual(count($basic_cords['longitude']), 3);

    // how to write and read cors correctly?
  }

  function testExifGPSToDecemicalCords()
  {

  }
}
