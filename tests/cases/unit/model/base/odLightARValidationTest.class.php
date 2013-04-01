<?php
require_once('limb/validation/src/lmbValidator.class.php');
require_once('limb/validation/src/lmbErrorList.class.php');

require_once('BaseLightARTest.class.php');

Mock :: generate('lmbValidator', 'MockValidator');
Mock :: generate('lmbErrorList', 'MockErrorList');

class TestLightARWithMockValidators extends TestLightAR
{
  protected $_db_table_name = 'test_one_table_object';
  protected $_non_db_fields = array('insert_validator', 'update_validator');
  public $insert_validator;
  public $update_validator;

  protected function _createInsertValidator()
  {
    return is_object($this->insert_validator) ? $this->insert_validator : new lmbValidator();
  }

  protected function _createUpdateValidator()
  {
    return is_object($this->update_validator) ? $this->update_validator : new lmbValidator();
  }
}

class odLightARValidationTest extends BaseLightARTest
{
  protected $tables_to_cleanup = array('test_one_table_object');

  /**
   * @return TestLightARWithMockValidators
   */
  protected function initSampleValidatedAR()
  {
    $object = new TestLightARWithMockValidators();
    $object->title = "Some title" . rand(0, 100);
    $object->content = "Some text" . rand(0, 100);
    $object->priority = rand(0, 10000);
    return $object;
  }

  /**
   * @return TestLightARWithMockValidators
   */
  protected function createSampleValidatedAR()
  {
    $object = $this->initSampleValidatedAR();
    $object->save();
    return $object;
  }

  function testGetErrorListReturnDefaultErrorList()
  {
    $object = $this->initSampleValidatedAR();
    $this->assertIsA($object->getErrorList(), 'lmbErrorList');
  }

  function testValidateNew()
  {
    $error_list = new lmbErrorList();
    $insert_validator = new MockValidator();
    $update_validator = new MockValidator();

    $object = $this->initSampleValidatedAR();
    $object->insert_validator = $insert_validator;
    $object->update_validator = $update_validator;

    $object->set('title', 'blah-blah');

    $insert_validator->expectOnce('setErrorList', [$error_list]);
    $insert_validator->expectOnce('validate', [$object]);
    $insert_validator->setReturnValue('validate', true);

    $update_validator->expectNever('setErrorList');
    $update_validator->expectNever('validate');

    $this->assertTrue($object->validate($error_list));
  }

  function testGetErrorListReturnLastErrorListUsed()
  {
    $error_list = new lmbErrorList();
    $insert_validator = new MockValidator();
    $object = $this->initSampleValidatedAR();
    $object->insert_validator = $insert_validator;
    $insert_validator->setReturnValue('validate', true);
    $object->validate($error_list);

    $this->assertReference($error_list, $error_list);
  }

  function testValidateNewFailed()
  {
    $error_list = new lmbErrorList();
    $insert_validator = new MockValidator();

    $object = $this->initSampleValidatedAR();
    $object->insert_validator = $insert_validator;

    $insert_validator->expectOnce('setErrorList', array($error_list));
    $insert_validator->expectOnce('validate', [$object]);
    $error_list->addError('foo');//simulating validation error

    $this->assertFalse($object->validate($error_list));
  }

  function testValidateExisting()
  {
    $error_list = new lmbErrorList();
    $insert_validator = new MockValidator();
    $update_validator = new MockValidator();

    $object = $this->createSampleValidatedAR();
    $object->insert_validator = $insert_validator;
    $object->update_validator = $update_validator;

    $update_validator->expectOnce('setErrorList', array($error_list));
    $update_validator->expectOnce('validate', [$object]);
    $update_validator->setReturnValue('validate', true);

    $insert_validator->expectNever('setErrorList');
    $insert_validator->expectNever('validate');

    $this->assertTrue($object->validate($error_list));
  }

  function testValidateExistingFailed()
  {
    $error_list = new lmbErrorList();
    $update_validator = new MockValidator();

    $object = $this->createSampleValidatedAR();
    $object->update_validator = $update_validator;

    $update_validator->expectOnce('setErrorList', array($error_list));
    $update_validator->expectOnce('validate', [$object]);
    $error_list->addError('foo');//simulating validation error

    $this->assertFalse($object->validate($error_list));
  }

  function testDontInsertOnValidationError()
  {
    $object = $this->initSampleValidatedAR();

    $error_list = new lmbErrorList();

    $validator = new MockValidator();

    $object->insert_validator = $validator;

    $validator->expectOnce('setErrorList', array($error_list));
    $validator->expectOnce('validate', [$object]);
    $error_list->addError('foo');//simulating validation error

    try
    {
      $object->save($error_list);
      $this->assertTrue(false);
    }
    catch(lmbValidationException $e)
    {
      $this->assertEqual($e->getErrorList(), $error_list);
    }

    $this->assertEqual($this->db->count('test_one_table_object'), 0);
  }

  function testInsertOnValidationSuccess()
  {
    $object = $this->initSampleValidatedAR();

    $error_list = new lmbErrorList();

    $validator = new MockValidator();
    $object->insert_validator = $validator;

    $validator->expectOnce('setErrorList', array($error_list));
    $validator->expectOnce('validate', [$object]);

    $object->save($error_list);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);
  }

  function testDoubleInsert_FirstSaveValidationError_But_SecondSaveIsOk()
  {
    $object = $this->initSampleValidatedAR();

    $validator = new MockValidator();
    $object->insert_validator = $validator;

    $error_list = new MockErrorList();
    $error_list->setReturnValueAt(0, 'isValid', false);
    $error_list->setReturnValueAt(1, 'isValid', true);

    try
    {
      $object->save($error_list);
      $this->assertTrue(false);
    }
    catch(lmbValidationException $e)
    {
      $this->assertTrue(true);
    }

    $this->assertEqual($this->db->count('test_one_table_object'), 0);

    $object->save($error_list);

    $this->assertEqual($this->db->count('test_one_table_object'), 1);
  }

  function testDontUpdateOnValidationError()
  {
    $object = $this->createSampleValidatedAR();
    $old_content = $object->content;

    $error_list = new lmbErrorList();

    $validator = new MockValidator();
    $object->update_validator = $validator;

    $object->set('content', $content = 'New content ' . time());

    $validator->expectOnce('setErrorList', array($error_list));
    $validator->expectOnce('validate', [$object]);
    $error_list->addError('foo');//simulating validation error

    try
    {
      $object->save($error_list);
      $this->assertTrue(false);
    }
    catch(lmbValidationException $e)
    {
      $this->assertEqual($e->getErrorList(), $error_list);
    }

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertEqual($record->get('content'), $old_content);
  }

  function testUpdateOnValidationSuccess()
  {
    $object = $this->createSampleValidatedAR();

    $error_list = new lmbErrorList();

    $validator = new MockValidator();
    $object->update_validator = $validator;

    $object->set('title', $title = 'New title ' . time());

    $validator->expectOnce('setErrorList', array($error_list));
    $validator->expectOnce('validate', [$object]);
    $validator->setReturnValue('validate', true);

    $object->save($error_list);

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertEqual($record->get('title'), $title);
  }

  function testDoubleUpdate_FirstSaveValidationError_But_SecondSaveIsOk()
  {
    $object = $this->createSampleValidatedAR();

    $validator = new MockValidator();
    $object->update_validator = $validator;

    $object->set('title', $title = 'Other title');

    $error_list = new MockErrorList();
    $error_list->setReturnValueAt(0, 'isValid', false);
    $error_list->setReturnValueAt(1, 'isValid', true);

    try
    {
      $object->save($error_list);
      $this->assertTrue(false);
    }
    catch(lmbValidationException $e)
    {
      $this->assertTrue(true);
    }

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertNotEqual($record->get('title'), $title);

    $object->save($error_list);

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertEqual($record->get('title'), $title);
  }

  function testSaveSkipValidation()
  {
    $object = $this->createSampleValidatedAR();

    $validator = new MockValidator();
    $object->update_validator = $validator;

    $object->set('title', $title = 'New title ' . time());

    $validator->expectNever('validate');

    $object->saveSkipValidation();

    $record = $this->db->selectRecord('test_one_table_object');
    $this->assertEqual($record->get('title'), $title);
  }

  function testIsValid()
  {
    $object = $this->initSampleValidatedAR();
    $this->assertTrue($object->isValid());
  }

  function testIsNotValid()
  {
    $error_list = new lmbErrorList();

    $object = $this->createSampleValidatedAR();
    $this->assertTrue($object->isValid());

    $error_list->addError('whatever');//actually it's a dirty simulation but that's how it works really

    try
    {
      $object->save($error_list);
    }
    catch(lmbException $e) {}
    $this->assertFalse($object->isValid());
  }
}
