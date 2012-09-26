<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');

class ImageableTest extends odAcceptanceTestCase
{
  function testAttachImage_local()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertImageUrl($url);
  }

  function testAttachImage_s3()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertImageUrl($url);
  }
}

class ImageableForTests extends BaseModel
{
  use Imageable;

  protected $_db_table_name = 'day';
}
