<?php
class UserFollowing extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  public static function isFollowing(User $follower_user, User $followed_user) {
    return !is_null(lmbActiveRecord::findOne('UserFollowing', array('follower_user_id=? AND user_id=?', $follower_user->getId(), $followed_user->getId())));
  }
}
