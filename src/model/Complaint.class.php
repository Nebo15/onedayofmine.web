<?php
lmb_require('src/model/base/BaseModel.class.php');

/**
 * @api
 */
class Complaint extends BaseModel
{
  protected $_db_table_name = 'complaint';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('text');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'day' => array ('field' => 'day_id', 'class' => 'Day', 'can_be_null' => true),
    );
  }

  function exportForApi(array $properties = null)
  {
    $exported = $this->export($properties);
    unset($exported['cip']);
    return (object) $exported;
  }
}
