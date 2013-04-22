<?php
lmb_require('src/model/base/BaseLike.class.php');

class DayLike extends BaseLike
{
  protected $_db_table_name = 'day_like';

  public $day_id;
  public $user_id;
  public $facebook_id;
  public $twitter_id;

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
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
    return self::findFirst(array('day_id = ?', $day_id));
  }

  static function findByDayIdAndUserId($day_id, $user_id)
  {
    return self::findFirst(array('day_id = ? AND user_id = ?', $day_id, $user_id));
  }

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->id;
    $export->user_id = $this->user_id;
    $export->day_id = $this->user_id;

    return $export;
  }
}
