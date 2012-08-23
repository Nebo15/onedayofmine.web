<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');
lmb_require('src/model/ModelWithImage.class.php');

class ModelWithImageTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    $conf = lmbToolkit::instance()->getConf('images');
    $conf['ModelWithImageForTests'] = array(
      'path'      => 'tests/:id_:image_width.:file_extension',
      'save_path' => "www/users",
      'sizes'     => array(
        array('width' => 266, 'height' => 266),
        array('width' => 532, 'height' => 532),
      ),
    );
    lmbToolkit::instance()->setConf('images', $conf);
  }

  function testAttachImage_local()
  {
    $model = new ModelWithImageForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertValidImageUrl($url);
  }

  function testAttachImage_s3()
  {
    $conf = lmbToolkit::instance()->getConf('amazon');
    $conf->S3['enabled'] = true;
    lmbToolkit::instance()->setConf('amazon', $conf);

    $model = new ModelWithImageForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertValidImageUrl($url);
  }
}

class ModelWithImageForTests extends ModelWithImage
{
  protected $_db_table_name = 'day';
}
