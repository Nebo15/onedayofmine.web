<?php
require_once('BaseLightARTest.class.php');

class TestLightCompositePKAR extends LightAR
{
  protected $_db_table_name = 'test_one_table_object_composite_pk';
  protected $_primary_key_fields = array("user_id", "stuff_id");
  protected $_composite_pk = true;
  protected $_exclude_id = true;

  public $user_id;
  public $stuff_id;
  public $title;
}

class LightARMultipleFieldPrimaryKeyTest extends DomovoyTestCase
{
  protected $tables_to_cleanup = array('test_one_table_object_composite_pk');

  private function initSampleAR()
  {
    static $stuff_id = 100;
    $object = new TestLightCompositePKAR($this->connection);
    $data = array('user_id' => 1, 'stuff_id' => $stuff_id++, 'title' => 'Some text');
    $object->import($data);
    return $object;
  }

  private function createSampleAR()
  {
    $object = $this->initSampleAR();
    $object->save();
    return $object;
  }

  function testForceLoad()
  {
    $object = new TestLightCompositePKAR($this->connection);
    $data = array('user_id' => 1, 'stuff_id' => 100, 'title' => 'Some text');
    $object->forceLoad($data);

    $this->assertTrue($object->isLoaded());
    $this->assertFalse($object->isDirty());
    $this->assertFalse($object->isNew());
  }

  function testSaveNewRecord()
  {
    $object = new TestLightCompositePKAR($this->connection);
    $object->set('user_id', $user_id = 1);
    $object->set('stuff_id', $stuff_id = 100);
    $object->set('title', $title = 'Super title');

    $this->assertTrue($object->isNew());

    $this->assertTrue($object->save());
    
    $this->assertFalse($object->isDirty());
    $this->assertFalse($object->isNew());
    $this->assertNull($object->id);

    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 1);

    $record = $this->db->selectRecord('test_one_table_object_composite_pk');
    $this->assertEqual($record->get('user_id'), $user_id);
    $this->assertEqual($record->get('stuff_id'), $stuff_id);
    $this->assertEqual($record->get('title'), $title);
  }

  function testDontCreateNewRecordTwice()
  {
    $object = $this->initSampleAR();

    $this->assertTrue($object->save());
    $this->assertFalse($object->save());

    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 1);
  }

  function testSaveUpdate()
  {
    $object = $this->initSampleAR();
    $object->save();

    $this->db->update('test_one_table_object_composite_pk',
                      array('title' => $updated_title = 'changed title'), 'user_id = ' . $object->user_id . " AND stuff_id = " . $object->stuff_id);

    $object->set('title', $content = 'Other content');
    $this->assertTrue($object->isDirty());

    $object->save();

    $this->assertFalse($object->isDirty());
    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 1);

    $record = $this->db->selectRecord('test_one_table_object_composite_pk');

    $this->assertEqual($record->get('title'), $content);
  }

  function testSaveUpdate_ChangeElementOfPrimaryField()
  {
    $object = $this->initSampleAR();
    $object->save();

    $object->set('stuff_id', $new_stuff_id = $object->stuff_id+10);
    $this->assertTrue($object->isDirty());

    $object->save();

    $this->assertFalse($object->isDirty());
    $record = $this->db->selectRecord('test_one_table_object_composite_pk');

    $this->assertEqual($record->get('stuff_id'), $new_stuff_id);
  }

  function testFindByIdThrowsException()
  {
    try
    {
      TestLightCompositePKAR :: findById($this->connection, $any_id = 1000, true);
      $this->assertTrue(false);
    }
    catch(lmbException $e)
    {
      $this->assertTrue(true);
    }
  }

  function testFindFirst()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();
    $this->assertFalse($object2->isNew());

    $found = TestLightCompositePKAR :: findFirst($this->connection, 'user_id = ' . $object1->user_id);
    $this->assertEqual($found->user_id, $object1->user_id);
    $this->assertEqual($found->stuff_id, $object1->stuff_id);
    $this->assertEqual($found->title, $object1->title);
  }

  function testFind_WithCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $rs = TestLightCompositePKAR :: find($this->connection, 'user_id = ' . $object2->user_id . ' AND stuff_id = ' . $object2->stuff_id);
    $rs->rewind();
    $this->assertEqual($object2->id, $rs->current()->id);
    $rs->next();
    $this->assertFalse($rs->valid());
  }

  function testDestroy()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 2);

    $object2->destroy();

    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 1);

    $record = $this->db->selectRecord('test_one_table_object_composite_pk');
    $this->assertEqual($record->get('title'), $object1->title);
  }

  function testDelete_ByCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $criteria = new lmbSQLFieldCriteria('stuff_id', $object2->stuff_id);
    TestLightCompositePKAR :: delete($this->connection, $criteria);

    $this->assertEqual($this->db->count('test_one_table_object_composite_pk'), 1);

    $found = TestLightCompositePKAR :: findFirst($this->connection, "stuff_id = " . $object1->stuff_id);
    $this->assertEqual($found->title, $object1->title);
  }
}

