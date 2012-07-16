<?php

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

  function exportForApi()
  {
    $exported = $this->export();
    unset($exported['cip']);
    return (object) $exported;
  }

}
