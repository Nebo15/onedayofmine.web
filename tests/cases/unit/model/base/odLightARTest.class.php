<?php
require_once('BaseLightARTest.class.php');

class odLightARTest extends BaseLightARTest
{
  function testHasAttribute()
  {
    $object = new TestLightAR();
    $this->assertTrue($object->has('id'));
    $this->assertTrue($object->has('title'));
    $this->assertFalse($object->has('no_such_field'));
  }

  function testLoadAndExport()
  {
    $object = new TestLightAR();
    $data = array('id' => 1, 'title' => "Some title", 'content' => 'Some text', 'priority' => 10);
    $object->forceLoad($data);

    $this->assertTrue($object->isLoaded());
    $this->assertFalse($object->isDirty());
    $this->assertFalse($object->isNew());

    $this->assertEqual($data['id'], $object->id);
    $this->assertEqual($data['title'], $object->title);
    $this->assertEqual($data['content'], $object->content);
    $this->assertEqual($data['priority'], $object->priority);

    $this->assertEqual($data, $object->export());
  }

  function testSaveNewRecord()
  {
    $object = new TestLightAR();
    $object->set('title', $title = 'Super title');
    $object->set('content', $content = 'Super content');
    $object->set('priority', $priority = 100);

    $this->assertTrue($object->isNew());

    $object->save();

    $this->assertFalse($object->isNew());
    $this->assertNotNull($object->id);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertEqual($record->get('id'), $object->id);
    $this->assertEqual($record->get('title'), $title);
    $this->assertEqual($record->get('content'), $content);
    $this->assertEqual($record->get('priority'), $priority);
  }

  function testDontSaveNonDbFields()
  {
    $object = $this->createSampleAR();
    $object->set('extra_info', "some extra data");
    $object->set('priority', 999);
    $object->save();

    $loaded_object = TestLightAR :: findById($object->id);
    $this->assertEqual(999, $loaded_object->priority);
  }

  function testDontCreateNewRecordTwice()
  {
    $object = $this->initSampleAR();

    $object->save();
    $object->save();

    $this->assertTrue($object->id);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);
  }

  /**
   * Проверяем 3 случая:
   * 1. Записываем только dirty поля, которые присваиваются через set()
   * 2. Неизмененные значения не пишутся в БД повторно
   * 3. Поля, измененные прямым доступом, не являются dirty
   * @todo Пока отключаем
   */
  function estSaveUpdate()
  {
    $object = $this->initSampleAR();
    $object->save();

    $this->db->update('test_one_table_object',
      array(
        'title' => $updated_title = 'changed title',
        'priority' => $priority = 120
      ),
      'id = ' . $object->id
    );

    $record = $this->db->selectRecord('test_one_table_object');

    $this->assertEqual($record->get('title'), $updated_title);
    $this->assertEqual($record->get('priority'), $priority);

    $object->set('content', $content = 'Other content');
    $object->priority = 111;

    $this->assertTrue($object->isDirty());

    $object->save();

    $this->assertFalse($object->isDirty());

    $this->assertEqual($this->db->count('test_one_table_object'), 1);

    $record = $this->db->selectRecord('test_one_table_object');

    $this->assertEqual($record->get('title'), $updated_title);
    $this->assertEqual($record->get('content'), $content);
    $this->assertEqual($record->get('priority'), $priority);
  }

  function testProperOrderOfSaveHooksCalls()
  {
    $object = new TestLightARWithHooks();
    $object->set('content', 'whatever');

    ob_start();
    $object->save();
    $str = ob_get_contents();
    ob_end_clean();
    $this->assertEqual($str, '|on_before_save||on_after_save|');

    $object->set('content', 'other content');

    ob_start();
    $object->save();
    $str = ob_get_contents();
    ob_end_clean();
    $this->assertEqual($str, '|on_before_save||on_after_save|');
  }

  function testProperOrderOfDestroyHooksCalls()
  {
    $object = new TestLightARWithHooks();
    $object->set('content', 'whatever');
    ob_start();
    $object->save();
    ob_clean();

    $object->destroy();
    $str = ob_get_contents();
    ob_end_clean();
    $this->assertEqual($str, '|on_before_destroy||on_after_destroy|');
  }

  function testDestroy()
  {
    $object = $this->initSampleAR();
    $object->save();

    $object->set('title', 'other title');

    $object->destroy();
    // объект полностью пустой, сохранять нечего
    $object->save();

    $this->assertTrue($object->isNew());
    $this->assertFalse($object->isLoaded());
    $this->assertFalse($object->isDirty());

    $this->assertEqual($this->db->count('test_one_table_object'), 0);
    $this->assertNull($this->db->selectRecord('test_one_table_object'));
  }

  function testFindById()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $found = TestLightAR :: findById($object2->id);
    $this->assertEqual($found->export(), $object2->export());
  }

	function testFindById_ByNull()
	{
		$object1 = $this->createSampleAR();

		$found = TestLightAR :: findById(null);
		$this->assertEqual(null, null);
	}

  function testFindByIdThrowsExceptionIfNotFound()
  {
    try
    {
      TestLightAR :: findById(-1000, true);
      $this->assertTrue(false);
    }
    catch(lmbException $e)
    {
      $this->assertTrue(true);
    }
  }

  function testFindByIdReturnsNullIfNotFound()
  {
    $this->assertNull(TestLightAR :: findById(-1000));
  }

	function testFindByIds()
	{
		$object1 = $this->createSampleAR();
		$object2 = $this->createSampleAR();
		$object3 = $this->createSampleAR();
		$object4 = $this->createSampleAR();

		$found = TestLightAR :: findByIds(array($object3->id, $object1->id, $object2->id));
		$this->assertEqual($found[0]->id, $object3->id);
		$this->assertEqual($found[1]->id, $object1->id);
		$this->assertEqual($found[2]->id, $object2->id);
	}

	function testFindByIds_withNulls()
	{
		$object1 = $this->createSampleAR();
		$found = TestLightAR :: findByIds(array($object1->id, null));
		$this->assertEqual(1, count($found));
		$this->assertEqual($found[0]->id, $object1->id);
	}

	function testFindByIds_withNotFoundedValues()
	{
		$object1 = $this->createSampleAR();

		$found = TestLightAR :: findByIds(array(-1000, $object1->id));
		$this->assertEqual(1, count($found));
		$this->assertEqual($found[0]->id, $object1->id);
	}

  function testFindFirst()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();
    $this->assertFalse($object2->isNew());

    $found = TestLightAR :: findFirst('id = ' . $object1->id);
    $this->assertEqual($found->id, $object1->id);
    $this->assertEqual($found->title, $object1->title);

    $found2 = TestLightAR :: findFirst(lmbSQLCriteria :: equal('id', $object2->id));
    $this->assertEqual($found2->id, $object2->id);
    $this->assertEqual($found2->title, $object2->title);
  }

  function testFindFirstWithSortParams()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $found1 = TestLightAR :: findFirst(null, array('id' => 'DESC'));
    $this->assertEqual($found1->id, $object2->id);

    $found2 = TestLightAR :: findFirst(null, array('id' => 'ASC'));
    $this->assertEqual($found2->id, $object1->id);
  }

  function testFind_AllNoCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $rs = TestLightAR :: find();
    $this->assertTrue($rs instanceof odLightARRecordSetDecorator);
    $rs->rewind();
    $this->assertEqual($object1->id, $rs->current()->id);
    $rs->next();
    $this->assertEqual($object2->id, $rs->current()->id);
  }

  function testFind_WithCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $rs = TestLightAR :: find('id = ' . $object2->id);
    $rs->rewind();
    $this->assertEqual($object2->id, $rs->current()->id);
    $rs->next();
    $this->assertFalse($rs->valid());
  }

  function testFindAllWithSortParams()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $rs = TestLightAR :: find(null, array('id' => 'DESC'));
    $arr = $rs->getArray();
    $this->assertEqual($arr[0]->id, $object2->id);
    $this->assertEqual($arr[1]->id, $object1->id);

    $rs = TestLightAR :: find(null, array('id' => 'ASC'));
    $arr = $rs->getArray();
    $this->assertEqual($arr[0]->id, $object1->id);
    $this->assertEqual($arr[1]->id, $object2->id);
  }

  function testFindBySql()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $rs = TestLightAR :: findBySql('select * from test_one_table_object order by  id desc');
    $rs->rewind();
    $this->assertEqual($object2->id, $rs->current()->id);
    $rs->next();
    $this->assertEqual($object1->id, $rs->current()->id);
    $rs->next();
    $this->assertFalse($rs->valid());
  }

  function testFindFirstBySql()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $object = TestLightAR :: findFirstBySql('select * from test_one_table_object order by  id desc');
    $this->assertEqual($object2->id, $object->id);
  }

  function testFind_ApplyDefaultSortParams()
  {
    $object1 = $this->createSampleAR();
    $object1->set('priority', 30);
    $object1->save();
    $object2 = $this->createSampleAR();
    $object2->set('priority', 50);
    $object2->save();
    $object3 = $this->createSampleAR();
    $object3->set('priority', 40);
    $object3->save();

    $rs = TestLightARWithOrder :: find();
    $arr = $rs->getArray();
    $this->assertEqual($object2->id, $arr[0]->id);
    $this->assertEqual($object3->id, $arr[1]->id);
    $this->assertEqual($object1->id, $arr[2]->id);
  }


  function testDelete_CallsDestroy()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    ob_start();
    TestLightARWithCustomDestroy :: delete();
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEqual($contents, 'destroyed!destroyed!');
    $this->assertEqual($this->db->count('test_one_table_object'), 0);
  }

  function testDelete_ByCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $criteria = new lmbSQLFieldCriteria('id', $object2->id);
    TestLightAR :: delete($criteria);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);

    $found = TestLightAR :: findById($object1->id);
    $this->assertEqual($found->content, $object1->content);
  }

  function testDeleteRaw_DoesntCallDestroy()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    ob_start();
    TestLightARWithCustomDestroy :: deleteRaw();
    $contents = ob_get_contents();
    ob_end_clean();

    $this->assertEqual($contents, '');
    $this->assertEqual($this->db->count('test_one_table_object'), 0);
  }

  function testDeleteRaw_ByCriteria()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $criteria = new lmbSQLFieldCriteria('id', $object2->id);
    TestLightAR :: deleteRaw($criteria);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);

    $found = TestLightAR :: findById($object1->id);
    $this->assertEqual($found->content, $object1->content);
  }
}

