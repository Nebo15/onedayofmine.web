<?php
class DayFavourite extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  public static function isFavourited(User $user, Day $day) {
    return !is_null(lmbActiveRecord::findOne('DayFavourite', array('user_id=? AND day_id=?', $user->getId(), $day->getId())));
  }
}
