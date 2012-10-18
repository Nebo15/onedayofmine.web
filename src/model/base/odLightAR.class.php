<?php
require_once('src/model/base/utils.inc.php');
require_once('src/model/base/odLightARRecordSetDecorator.class.php');
require_once('limb/validation/src/lmbValidator.class.php');
require_once('limb/validation/src/lmbErrorList.class.php');
require_once('limb/dbal/src/query/lmbSelectQuery.class.php');

abstract class odLightAR extends odDirtableObject implements ArrayAccess
{
  public $id = null;

  /** @var lmbDbConnection */
  protected $_db_conn = null;
  /** @var lmbErrorList */
  protected $_error_list;

  private $_is_loaded = false;

  // primary keys
  protected $_primary_key_fields = array();
  protected $_changed_primary = array();
  protected $_composite_pk = false;
  protected $_exclude_id = false; // грязно, но приходится сделать из-за BC

  protected $_db_table_name = null;
  protected $_lazy_db_fields = array();
  protected $_non_db_fields = array();
  protected $_default_sort_params = array();
  protected $_unescape_fields = array();

  private $_fields = array();

  protected $ctime_field = 'ctime';
  protected $utime_field = 'utime';
  protected $reverse_id_field = 'reverse_id';

  function __construct($id = null, lmbDbConnection $conn = null)
  {
    $this->_db_conn = $conn ? $conn : lmbToolkit::instance()->getDefaultDbConnection();
    lmb_assert_type($this->_db_table_name, 'string', 'Set db table name for '.get_class($this));

    $this->_fillFields();

    lmb_assert_true(sizeof($this->_fields) > 0);

    if($id)
    {
      lmb_assert_type($id, 'integer');
      $this->id = intval($id);
    }
  }

  function set($name, $value)
  {
    if($this->_composite_pk && in_array($name, $this->_primary_key_fields))
    {
      if($this->$name != $value)
        $this->_changed_primary[$name] = $this->$name;
    }

    parent::set($name, $value);
  }

  public function hasCompositePK()
  {
    return $this->_composite_pk;
  }

  private function _fillFields()
  {
    $props = od_get_public_props($this);
    if($this->_exclude_id)
      unset($props["id"]);
    $this->_fields = array_keys($props);
  }

  function getDbTableName()
  {
    return $this->_db_table_name;
  }

  function getDbConnection()
  {
    return $this->_db_conn;
  }

  function getFields()
  {
    return $this->_fields;
  }

  function has($attribute)
  {
    return in_array($attribute, $this->_fields);
  }

  function getDbFieldsForSelect($force_include_lazy_fields = array())
  {
    $all_fields = $this->getFields();
    if(!$force_include_lazy_fields)
      $res = array_diff($all_fields, $this->_lazy_db_fields);
    else
    {
      $res = array_diff($all_fields, $this->_lazy_db_fields);
      if(is_array($force_include_lazy_fields))
        $res = array_merge($res, $force_include_lazy_fields);
      else
        $res = $all_fields;
    }

    $res = array_diff($res, $this->_non_db_fields);

    return $res;
  }

  function isNew()
  {
    return !$this->isLoaded();
  }

  function isLoaded()
  {
    return $this->_is_loaded;
  }

  function import(array $props)
  {
    foreach($props as $key => $value)
      $this->set($key, $value);
  }

  function export()
  {
    $all_props = od_get_public_props($this);

    $result = array();
    foreach($all_props as $key => $value)
      if(!is_null($value))
        $result[$key] = $value;

    return $result;
  }

  function validate(lmbErrorList $error_list = null)
  {
    if($error_list)
      $this->_error_list = $error_list;

    if($this->isNew())
      $this->_validateInsert();
    else
      $this->_validateUpdate();

    return $this->isValid();
  }

  function save(lmbErrorList $error_list = null)
  {
    $this->doSave(true, $error_list);
    return $this;
  }

  function saveSkipValidation()
  {
    return $this->doSave(false);
  }

  private function doSave($need_validation = true, lmbErrorList $error_list = null)
  {
    if($error_list)
      $this->_error_list = $error_list;

    $this->_onBeforeSave();

//    if($this->isLoaded() && !$this->isDirty())
//    {
//      $this->_onAfterSave();
//      return false;
//    }

    $this->_setAutoTimes();

    $data = $this->getDataForSave();

    if($need_validation)
      $this->performValidation();

    if(!count($data))
      return false;

    if($this->isLoaded())
    {
      lmbDBAL :: table($this->_db_table_name, $this->_db_conn)->update($data, $this->_getRecordCriteria());
    }
    else
    {
      $id = lmbDBAL :: table($this->_db_table_name, $this->_db_conn)->insert($data);
      if(!$this->_composite_pk)
        $this->id = $id;

      $this->_is_loaded = true;
    }

    $this->_setReverseId();

    $this->undirty();

    $this->_onAfterSave();

    return true;
  }

  function undirty()
  {
    $this->_changed_primary = array();
    parent::undirty();
  }


  function _getRecordCriteria()
  {
    $criteria = new lmbSQLCriteria();
    if(!$this->_composite_pk)
      $criteria->addAnd("id = " . $this->id);
    else
    {
      foreach($this->_primary_key_fields as $field)
        $criteria->addAnd(lmbSQLCriteria::equal($field, $this->_getPrimaryFieldValue($field)));
    }
    return $criteria;
  }

  function _getPrimaryFieldValue($name)
  {
    if(isset($this->_changed_primary[$name]))
      return $this->_changed_primary[$name];
    return $this->$name;
  }

  protected function _setAutoTimes()
  {
    if($this->isNew() && in_array($this->ctime_field, $this->_fields) && !$this->{$this->ctime_field})
      $this->set($this->ctime_field, time());

    if(in_array($this->utime_field, $this->_fields))
      $this->set($this->utime_field, time());
  }

  protected function _setReverseId()
  {
    if(!in_array($this->reverse_id_field, $this->_fields) || $this->{$this->reverse_id_field})
      return;

    if($this->_composite_pk)
      throw new lmbException("LightAR '". get_class($this) . "' has composite primary key so does not support reverse_id");

    $reverse_id = (int) (lmb_env_get('MAX_ID_VALUE') - $this->id);
    $db = new lmbSimpleDb($this->_db_conn);
    $db->update($this->_db_table_name, array('reverse_id' => $reverse_id), 'id =' . $this->id);
    $this->set($this->reverse_id_field, $reverse_id);
  }

  protected function performValidation()
  {
    if($this->isNew())
      $this->_validateInsert();
    else
      $this->_validateUpdate();

    if(!$this->isValid())
    {
      lmb_require('limb/validation/src/exception/lmbValidationException.class.php');
      throw new lmbValidationException('LightAR "' . get_class($this) . '" validation failed', $this->_error_list);
    }
  }

  protected function _validateInsert()
  {
    return $this->_validate($this->_createInsertValidator());
  }

  protected function _validateUpdate()
  {
    return $this->_validate($this->_createUpdateValidator());
  }

  protected function _validate(lmbValidator $validator)
  {
    $error_list = $this->getErrorList();
    $validator->setErrorList($error_list);
    $validator->validate($this);

    $this->_onValidate();
  }

  /**
   * @return lmbValidator
   */
  protected function _createValidator()
  {
    lmb_require('limb/validation/src/lmbValidator.class.php');
    return new lmbValidator();
  }

  /**
   *  @return lmbValidator
   */
  protected function _createInsertValidator()
  {
    return $this->_createValidator();
  }

  /**
   *  @return lmbValidator
   */
  protected function _createUpdateValidator()
  {
    return $this->_createValidator();
  }

  private function getDataForSave()
  {
//    if($this->isLoaded())
//      $fields = array_intersect($this->_fields, array_keys($this->getDirtyProps()));
//    else
    $fields = $this->_fields;

    $fields = array_diff($fields, $this->_non_db_fields);

    $data = array();
    foreach($fields as $field)
    {
      if(isset($this->$field))
      {
        if(in_array($field, $this->_unescape_fields))
          $data[$field] = $this->$field;
        else
          $data[$field] = $this->_db_conn->escape($this->$field);
      }
    }

    return $data;
  }

  /**
   * @return bool
   */
  function isValid()
  {
    return $this->getErrorList()->isValid();
  }

  /**
   * @return lmbErrorList
   */
  function getErrorList()
  {
    if(!$this->_error_list)
      $this->_error_list = new lmbErrorList();

    return $this->_error_list;
  }

  function forceLoad(array $data)
  {
    foreach($data as $k => $v)
      $this->$k = $v;

    if(!$this->_composite_pk)
    {
      lmb_assert_true($this->id !== null);
      $this->id = intval($this->id);
    }
    $this->_is_loaded = true;
    $this->undirty();
    $this->_onAfterLoad();
  }

  function destroy()
  {
    $this->_onBeforeDestroy();

    if(!$this->isNew())
      lmbDBAL :: deleteQuery($this->_db_table_name, $this->_db_conn)->where($this->_getRecordCriteria())->execute();

    $this->undirty();

    $this->id = null;
    $this->_is_loaded = false;

    foreach($this->_fields as $field)
      $this->$field = null;

    $this->_onAfterDestroy();
  }

  /**
   * @return odLightAR|null
   */
  public static function findById($id, $throw_exception = false, $with_lazy_attributes = false)
  {
    $class_name = get_called_class();

    /** @var $object odLightAR */
    $object = new $class_name();

    if($object->hasCompositePK())
      throw new lmbException("LightAR '{$class_name}' has composite primary key so does not support findById method");

    $rs = $object->fetchRecords('id=' . intval($id), null, $with_lazy_attributes);
    $rs->rewind();

    if($rs->valid())
    {
      $record = $rs->current();
      $object->forceLoad($record->export());
      return $object;
    }

    if($throw_exception)
      throw new lmbException("LightAR '{$class_name}' with id '{$id}' not found");
  }

  public static function findByIds(array $ids, $order = null, $with_lazy_attributes = false)
  {
    return self::find(lmbSQLCriteria::in('id', $ids), $order, $with_lazy_attributes);
  }

  /**
   * @return odLightAR|null
   */
  public static function findFirst($criteria = null, $order = null, $with_lazy_attributes = false)
  {
    $class_name = get_called_class();

    /** @var $object LightAR */
    $object = new $class_name();
    $rs = $object->fetchRecords($criteria, $order, $with_lazy_attributes);
    $rs->rewind();

    if($rs->valid())
    {
      $record = $rs->current();
      $object->forceLoad($record->export());
      return $object;
    }
    return null;
  }

  /**
   * @return odLightARRecordSetDecorator
   */
  public static function find($criteria = null, $order = null, $with_lazy_attributes = false)
  {
    $class_name = get_called_class();
    /** @var $object LightAR */
    $object = new $class_name();
    return new odLightARRecordSetDecorator($object->fetchRecords($criteria, $order, $with_lazy_attributes), $class_name);
  }

  static function findByQuery(lmbSelectQuery $query)
  {
    $class_name = get_called_class();
    return $class_name::findBySql($query->getStatement()->getSQL());
  }

  static function findBySql($sql)
  {
    $class_name = get_called_class();
    return new odLightARRecordSetDecorator(lmbDBAL :: fetch($sql), $class_name);
  }

  public static function findFirstBySql($sql)
  {
    $class_name = get_called_class();
    /** @var $object LightAR */
    $object = new $class_name();
    $rs = $class_name :: findBySql($sql);
    $rs->rewind();

    if($rs->valid())
    {
      $record = $rs->current();
      $object->forceLoad($record->export());
      return $object;
    }
    return null;
  }

  public static function delete($criteria = null)
  {
    $class_name = get_called_class();
    /** @var $object LightAR */
    $object = new $class_name();
    $rs = new odLightARRecordSetDecorator($object->fetchRecords($criteria), $class_name);
    foreach($rs as $ar)
      $ar->destroy();
  }

  public static function deleteRaw($criteria = null)
  {
    $class_name = get_called_class();
    /** @var $object LightAR */
    $object = new $class_name();
    $query = new lmbDeleteQuery($object->getDbTableName());
    if($criteria)
      $query->addCriteria($criteria);

    return $query->execute();
  }

  /**
   * @return lmbDbRecordSet
   */
  public function fetchRecords($criteria = null, $order = null, $with_lazy_attributes = false)
  {
    $db_table_name = $this->getDbTableName();

    $query = new lmbSelectQuery($db_table_name, $this->_db_conn);
    foreach($this->getDbFieldsForSelect($with_lazy_attributes) as $field)
      $query->addField($field);

    if($criteria)
      $query->addCriteria($criteria);

    if($order)
      $query->addOrder($order);
    elseif(count($this->_default_sort_params))
      $query->addOrder($this->_default_sort_params);

    return $query->getRecordSet();
  }

  /**#@+
   * Implements ArrayAccess interface
   * @see ArrayAccess
   */
  function offsetExists($offset)
  {
    return isset($this->$offset);
  }

  function offsetGet($offset)
  {
    return $this->$offset;
  }

  function offsetSet($offset, $value)
  {
    $this->set($offset, $value);
  }

  function offsetUnset($offset)
  {
    unset($this->$offset);
  }
  /**#@-*/


  protected function _onBeforeSave() {}
  protected function _onAfterSave() {}
  protected function _onAfterLoad() {}
  protected function _onBeforeDestroy() {}
  protected function _onAfterDestroy() {}
  protected function _onValidate(){}
}
