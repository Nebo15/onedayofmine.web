<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.class.php');

class ImageableIntegrationTest extends odIntegrationTestCase
{
  function testAttachImage_s3()
  {
    $model = new ImageableForIntegrationTests();
    $model->title = 'testAttachImage_s3';
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertImageUrl($url);
  }

  function testDestroy_s3()
  {
    $model = new ImageableForIntegrationTests();
    $model->title = 'testDestroy_s3';
    $model->save();
    $model->attachImage($this->generator->image());

    $url = lmbToolkit::instance()->getStaticUrl($model->getImage());
    $this->assertImageUrl($url);

    $model->destroy();
    $this->assert404Url($url);
  }
}

class ImageableForIntegrationTests extends BaseModel
{
  use Imageable;

  public $title;

  protected $_db_table_name = 'day';
}
