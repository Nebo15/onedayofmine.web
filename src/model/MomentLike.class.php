<?php
lmb_require('src/model/base/BaseLike.class.php');

class MomentLike extends BaseLike
{
  protected function _defineRelations()
  {
    parent::_defineRelations();
    $this->_many_belongs_to['moment'] = array ('field' => 'moment_id', 'class' => 'Moment');
  }

  static function findByMomentId($moment_id)
  {
    return self::findFirst(array('moment_id = ?', $moment_id));
  }

  static function findByMomentIdAndUserId($moment_id, $user_id)
  {
    return self::findFirst(array('moment_id = ? AND user_id = ?', $moment_id, $user_id));
  }
}
