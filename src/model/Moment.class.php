<?php

class Moment extends lmbActiveRecord
{
  protected $_db_table_name = 'moment';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('description');

  protected function _defineRelations()
  {
    $this->_has_many = array (
      'moment_comments' => array ('field' => 'moment_id', 'class' => 'MomentComment'),
    );
    $this->_many_belongs_to = array (
      'day' => array ('field' => 'day_id', 'class' => 'Day')
    );
  }
}
