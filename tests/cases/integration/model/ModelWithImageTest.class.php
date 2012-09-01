<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');
lmb_require('src/model/Imageable.class.php');

class ImageableTest extends odAcceptanceTestCase
{
  function testAttachImage_local()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertValidImageUrl($url);
  }

  function testAttachImage_s3()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertValidImageUrl($url);
  }
}

class ImageableForTests extends Imageable
{
  protected $_db_table_name = 'day';
}
