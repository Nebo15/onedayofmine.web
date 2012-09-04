<?php
lmb_require('src/model/base/BaseLike.class.php');

class DayCommentLike extends BaseLike
{
  protected function _defineRelations()
  {
    parent::_defineRelations();
    $this->_many_belongs_to['day_comment'] = array ('field' => 'day_comment_id', 'class' => 'DayComment');
  }

  static function findByDayCommentId($day_comment_id)
  {
    return self::findOne(array('day_comment_id = ?', $day_comment_id));
  }

  static function findByDayCommentIdAndUserId($day_comment_id, $user_id)
  {
    return self::findOne(array('day_comment_id = ? AND user_id = ?', $day_comment_id, $user_id));
  }
}
