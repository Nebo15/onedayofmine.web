<?php
lmb_require('src/model/base/BaseLike.class.php');

class DayLike extends BaseLike
{
  protected function _defineRelations()
  {
    parent::_defineRelations();
    $this->_many_belongs_to['day'] = array ('field' => 'day_id', 'class' => 'Day');
  }

  static function findByDayId($day_id)
  {
    return self::findOne(array('day_id = ?', $day_id));
  }

  static function deleteUserLikeInDay(User $user, Day $day)
  {
    $criteria = lmbSQLCriteria::equal('day_id', $day->getId());
    $criteria->add(lmbSQLCriteria::equal('user_id', $user->getId()));

    return self::deleteRaw($criteria);
  }
}
