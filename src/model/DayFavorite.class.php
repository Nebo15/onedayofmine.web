<?php
lmb_require('src/model/base/BaseModel.class.php');

class DayFavorite extends BaseModel
{
  protected $_db_table_name = 'day_favorite';
  protected $_exclude_id = true;
  protected $_composite_pk = true;
  protected $_default_sort_params = array('day_id'=>'asc');

  public $day_id;
  public $user_id;
  public $ctime;

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }

  static function isFavorited(User $user, Day $day)
  {
    return (bool) DayFavorite::find(
      lmbSQLCriteria::equal('user_id', $user->id)
        ->addAnd(lmbSQLCriteria::equal('day_id', $day->id))
    )->count();
  }

  static function findByDayIdAndUserId($day_id, $user_id)
  {
    $criteria = lmbSQLCriteria::equal('day_id', $day_id)
      ->add(lmbSQLCriteria::equal('user_id', $user_id));
    return self::findFirst($criteria);
  }
}
