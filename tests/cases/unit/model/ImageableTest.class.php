<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');

class ImageableTest extends odUnitTestCase
{
  function testAttachImage_local()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertValidImageUrl($url);
  }

  function testDestroy_local()
  {
    $model = new ImageableForTests();
    $model->save();
    $model->attachImage($this->generator->image());
    $model->destroy();

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assert404Url($url);
  }
}

class ImageableForTests extends BaseModel
{
  use Imageable;

  protected $_db_table_name = 'day';
}
