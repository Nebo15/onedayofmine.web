<?php
class UserFollowing extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  public static function isUserFollowUser(User $follower_user, User $followed_user) {
    return !is_null(lmbActiveRecord::findOne('UserFollowing', array('follower_user_id=? AND user_id=?', $follower_user->getId(), $followed_user->getId())));
  }

  public static function isUsersFollowUser(lmbCollectionInterface $follower_users, User $followed_user) {
    if(!$followed_user->getId())
      throw new lmbException("Can't retrieve user id");

    if(!$follower_users->count())
      return [];

    $following_ids = [];
    foreach ($follower_users as $user) {
      $following_ids[$user->getId()] = false;
    }

    $criteria = lmbSQLCriteria::in('follower_user_id', array_keys($following_ids));
    $criteria->add(lmbSQLCriteria::equal('user_id', $followed_user->getId()));
    $following = UserFollowing::find(array(
      'criteria' => $criteria
    ));

    foreach ($following as $following_item) {
      $following_ids[$following_item->getFollowerUserId()] = true;
    }

    return $following_ids;
  }

  public static function isUserFollowUsers(User $follower_user, lmbCollectionInterface $followed_users) {
    if(!$follower_user->getId())
      throw new lmbException("Can't retrieve user id");

    if(!$followed_users->count())
      return [];

    $following_ids = [];
    foreach ($followed_users as $user) {
      if(!$user->getId())
        throw new lmbException("Can't retrieve user id");

      $following_ids[$user->getId()] = false;
    }

    $criteria = lmbSQLCriteria::in('user_id', array_keys($following_ids));
    $criteria->add(lmbSQLCriteria::equal('follower_user_id', $follower_user->getId()));
    $following = UserFollowing::find(array(
      'criteria' => $criteria
    ));

    foreach ($following as $following_item) {
      $following_ids[$following_item->getUserId()] = true;
    }

    return $following_ids;
  }
}
