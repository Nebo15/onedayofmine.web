<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');
lmb_require('src/model/ModelWithImage.class.php');

class ModelWithImageTest extends odAcceptanceTestCase
{
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
