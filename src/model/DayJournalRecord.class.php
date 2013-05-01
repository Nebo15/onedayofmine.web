<?php

class DayJournalRecord extends BaseModel
{
	protected $_db_table_name = 'day_journal';
	protected $_default_sort_params = array('id'=>'DESC');

	public $day_id, $user_id;
	public $ctime, $cip;

	function setDay(Day $day)
	{
		$this->day_id = $day->id;
	}

	function getDay()
	{
		return Day::findById($this->day_id);
	}

	function setUser(User $user)
	{
		$this->user_id = $user->id;
	}

	function getUser()
	{
		return User::findById($this->user_id);
	}

	static function findByDayId($day_id)
	{
		return self::findFirst(lmbSQLCriteria::equal('day_id', $day_id));
	}
}
