<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/model/traits/Imageable.class.php');

class ImageableTest extends odUnitTestCase
{
  function testAttachImage_local()
  {
    $model = new ImageableForTests();
    $model->title = 'testAttachImage_local';
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertImageUrl($url);
  }

  function testDestroy_local()
  {
    $model = new ImageableForTests();
    $model->title = 'testDestroy_local';
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());

    $model->destroy();

    $this->assert404Url($url);
  }
}

class ImageableForTests extends BaseModel
{
  use Imageable;

  public $title;

  protected $_db_table_name = 'test_imageable';
}
