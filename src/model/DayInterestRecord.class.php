<?php

// Can be removed?
class DayInterestRecord extends BaseModel
{
  protected $_db_table_name = 'day_interest';
  protected $_default_sort_params = array('rating'=>'DESC');

  public $day_id;

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }
}
