<?php

// Can be removed?
class DayInterestRecord extends lmbActiveRecord
{
  protected $_db_table_name = 'day_interest';
  protected $_default_sort_params = array('rating'=>'DESC');

  protected function _defineRelations()
  {
    $this->_has_one = array (
      'day' => array (
        'field' => 'day_id',
        'class' => 'Day',
        'cascade_delete' => false
      )
    );
  }
}
