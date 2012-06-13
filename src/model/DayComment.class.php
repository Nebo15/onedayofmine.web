<?php

class DayComment extends lmbActiveRecord
{
  protected $_db_table_name = 'day_comment';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('text');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User'),
      'day' =>  array ('field' => 'day_id', 'class' => 'Day'),
    );

  }

}
