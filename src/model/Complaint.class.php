<?php

class Complaint extends BaseModel
{
  protected $_db_table_name = 'complaint';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('text');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User', 'can_be_null' => true),
      'day' => array ('field' => 'day_id', 'class' => 'Day', 'can_be_null' => true),
      'moment' => array ('field' => 'moment_id', 'class' => 'Moment', 'can_be_null' => true),
    );
  }

}
