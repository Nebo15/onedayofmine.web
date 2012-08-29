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
}
