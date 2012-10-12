<?php
lmb_require('src/model/base/BaseModel.class.php');

class DayFavorite extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  static function isFavorited(User $user, Day $day)
  {
    return (bool) DayFavorite::find(
      lmbSQLCriteria::equal('user_id', $user->id)
        ->addAnd(lmbSQLCriteria::equal('day_id', $day->id))
    )->count();
  }

  static function findByDayIdAndUserId($day_id, $user_id)
  {
    return self::findFirst(array('day_id = ? AND user_id = ?', $day_id, $user_id));
  }
}
