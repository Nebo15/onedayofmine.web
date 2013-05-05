<?php
lmb_require('src/model/Day.class.php');

class DayJournalRecord extends BaseModel
{
	protected $_db_table_name = 'day_journal';
	protected $_default_sort_params = array('id'=>'DESC');

	public $day_id, $user_id;
	public $ctime, $cip;

	protected function _createValidator()
	{
		$validator = new lmbValidator();
		$validator->addRequiredRule('user_id');
		$validator->addRequiredRule('day_id');
		return $validator;
	}

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

	static function findDaysWithLimitation($from_day_id = null, $to_day_id = null, $limit = null)
	{
		$query = new lmbSelectQuery('day_journal');
		$query->addField('*');
		$query->addRawOrder("id DESC");
		$info = $query->fetch();

		$ids = lmbArrayHelper::getColumnValues('day_id', $info);

		if($from_day_id)
		{
			$founded_pos = array_search((string) $from_day_id, $ids);
			$from_key =  false !== $founded_pos ? $founded_pos + 1 : 0;
		}
		else
			$from_key = 0;

		if($to_day_id)
		{
			$founded_pos = array_search((string) $to_day_id, $ids);
			$to_key =  false !== $founded_pos ? $founded_pos: 0;
		}
		else
			$to_key = count($ids);

		if(!$limit)
			$limit = 100;

		$ids = array_slice($ids, $from_key, $to_key - $from_key);
		$ids = array_slice($ids, 0, $limit);

		if(!count($ids))
			return [];

		$days = [];
		foreach(Day::findByIds($ids) as $day)
		{
			if(1 == $day->is_deleted)
				continue;
			if(!$day->getImage())
				continue;
			foreach($info as $record)
			{
				if($record['day_id'] == $day->id)
				{
					$days[$record['id']] = $day;
					break;
				}
			}
		}

		ksort($days, SORT_NUMERIC);

		return array_reverse($days);
	}
}
