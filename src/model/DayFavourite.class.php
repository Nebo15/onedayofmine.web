<?php
lmb_require('src/model/base/BaseModel.class.php');

class DayFavourite extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  public static function isFavourited(User $user, Day $day)
  {
    return (bool) DayFavourite::find(
      lmbSQLCriteria::equal('user_id', $user->getId())
        ->addAnd(lmbSQLCriteria::equal('day_id', $day->getId()))
    )->count();
  }
}
