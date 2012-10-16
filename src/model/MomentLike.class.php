<?php
lmb_require('src/model/base/BaseLike.class.php');

class MomentLike extends BaseLike
{
  protected $_db_table_name = 'moment_like';

  public $moment_id;
  public $user_id;

  function setMoment($moment)
  {
    lmb_assert_type($moment, 'Moment');
    $this->moment_id = $moment->id;
  }

  function setUser($user)
  {
    lmb_assert_type($user, 'User');
    $this->user_id = $user->id;
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
