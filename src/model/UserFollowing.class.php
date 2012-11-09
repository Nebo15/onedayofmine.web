<?php
lmb_require('src/model/base/BaseModel.class.php');

class UserFollowing extends BaseModel
{
  protected $_db_table_name = 'user_following';
  protected $_default_sort_params = array('ctime'=>'asc');

  public $user_id;
  public $follower_user_id;
  public $ctime;

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }

  function setFollowerUser(User $user)
  {
    $this->follower_user_id = $user->id;
  }

  public static function isUserFollowUser(User $follower_user, User $followed_user)
  {
    $criteria = lmbSQLCriteria::create()
      ->add(lmbSQLCriteria::equal('follower_user_id', $follower_user->id))
      ->add(lmbSQLCriteria::equal('user_id', $followed_user->id));
    return !is_null(UserFollowing::findFirst($criteria));
  }

  public static function isUsersFollowUser($follower_users, User $followed_user)
  {
    if(!$followed_user->id)
      throw new lmbException("Can't retrieve user id");

    if(!count($follower_users))
      return [];

    $following_ids = [];
    foreach ($follower_users as $user) {
      $following_ids[$user->id] = false;
    }

    $criteria = lmbSQLCriteria::in('follower_user_id', array_keys($following_ids));
    $criteria->add(lmbSQLCriteria::equal('user_id', $followed_user->id));
    $following = UserFollowing::find($criteria);

    foreach ($following as $following_item) {
      $following_ids[$following_item->follower_user_id] = true;
    }

    return $following_ids;
  }

  public static function isUserFollowUsers(User $follower_user, lmbCollectionInterface $followed_users)
  {
    if(!$follower_user->id)
      throw new lmbException("Can't retrieve user id");

    if(!$followed_users->count())
      return [];

    $following_ids = lmbArrayHelper::getColumnValues('id', $followed_users);

    $result = array_fill_keys($following_ids, false);

    $criteria = lmbSQLCriteria::in('user_id', $following_ids);
    $criteria->add(lmbSQLCriteria::equal('follower_user_id', $follower_user->id));
    $following = UserFollowing::find($criteria);

    foreach ($following as $following_item) {
      $result[$following_item->user_id] = true;
    }

    return $result;
  }
}
