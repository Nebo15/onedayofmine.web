<?php
lmb_require('src/model/base/BaseLike.class.php');

class MomentCommentLike extends BaseLike
{
  protected function _defineRelations()
  {
    parent::_defineRelations();
    $this->_many_belongs_to['moment_comment'] = array ('field' => 'moment_comment_id', 'class' => 'MomentComment');
  }

  static function findByMomentCommentId($moment_comment_id)
  {
    return self::findOne(array('moment_comment_id = ?', $moment_comment_id));
  }

  static function findByMomentCommentIdAndUserId($moment_comment_id, $user_id)
  {
    return self::findOne(array('moment_comment_id = ? AND user_id = ?', $moment_comment_id, $user_id));
  }
}
