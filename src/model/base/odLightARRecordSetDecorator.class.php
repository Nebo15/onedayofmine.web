<?php
lmb_require('limb/core/src/lmbCollectionDecorator.class.php');
lmb_require('limb/core/src/lmbSet.class.php');

class odLightARRecordSetDecorator extends lmbCollectionDecorator
{
  protected $conn;
  protected $classname;

  function __construct(lmbDbRecordSet $record_set, $classname, $conn = null)
  {
    $this->conn = $conn ? $conn : lmbToolkit::instance()->getDefaultDbConnection();
    $this->classname = $classname;

    parent :: __construct($record_set);
  }

  /**
   * @return LightAR
   */
  function current()
  {
    if(!$record = parent :: current())
      return null;

    return $this->createObjectFromRecord($record);
  }

  /**
   * @return LightAR
   */
  function at($pos)
  {
    if(!$record = parent :: at($pos))
      return null;

    return $this->createObjectFromRecord($record);
  }

  /**
   * @return LightAR
   */
  function createObjectFromRecord(lmbDbRecord $record)
  {
    $class_name = $this->classname;

    /** @var $object LightAR */
    $object = new $class_name();
    $object->forceLoad($record->export());

    return $object;
  }
}


