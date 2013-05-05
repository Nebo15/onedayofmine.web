<?php

class DayInterestRecord extends BaseModel
{
  protected $_db_table_name = 'day_interest';
  protected $_default_sort_params = array('rating'=>'DESC');

  public $day_id;
  public $rating;
  public $is_pinned;

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }

  function getDay()
  {
    return Day::findById($this->day_id);
  }

	static function findByDayId($day_id)
	{
		return DayInterestRecord::findFirst(lmbSQLCriteria::equal('day_id', $day_id));
	}
}
