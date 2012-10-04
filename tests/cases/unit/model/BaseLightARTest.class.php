<?php
lmb_require('limb/dbal/src/criteria/lmbSQLRawCriteria.class.php');

class TestLightAR extends LightAR
{
  protected $_db_table_name = 'test_one_table_object';
  protected $_non_db_fields = array('extra_info');
  
  public $priority;
  public $title;
  public $content;
  public $extra_info;
}

class TestLightARWithTimes extends LightAR
{
  protected $_db_table_name = 'test_one_table_object_with_times';

  public $priority;
  public $ctime;
  public $utime;
}

class TestLightARWithReverseId extends LightAR
{
  protected $_db_table_name = 'test_one_table_object_with_reverse_id';

  public $priority;
  public $reverse_id;
}

class TestLightARWithHooks extends TestLightAR
{
  protected function _onBeforeSave()
  {
    echo '|on_before_save|';
  }

  protected function _onAfterSave()
  {
    echo '|on_after_save|';
  }

  protected function _onBeforeDestroy()
  {
    echo '|on_before_destroy|';
  }

  protected function _onAfterDestroy()
  {
    echo '|on_after_destroy|';
  }
}

class TestLightARWithCustomDestroy extends TestLightAR
{
  function destroy()
  {
    parent :: destroy();
    echo "destroyed!";
  }
}

class TestLightARWithLazyAttributes extends TestLightAR
{
  protected $_lazy_db_fields = array('content', 'title');
}

class TestLightARWithOrder extends TestLightAR
{
  protected $_default_sort_params = array('priority' => 'desc');
}

abstract class BaseLightARTest extends DomovoyTestCase
{
  protected $tables_to_cleanup = array('test_one_table_object');

  /**
   * @return TestLightAR
   */
  public function initSampleAR()
  {
    $object = new TestLightAR($this->connection);
    $object->title = "Some title" . rand(0, 100);
    $object->content = "Some text" . rand(0, 100);
    $object->priority = rand(0, 10000);
    return $object;
  }

  /**
   * @return TestLightAR
   */
  public function createSampleAR()
  {
    $object = $this->initSampleAR();
    $object->save();
    return $object;
  }
}

