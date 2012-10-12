<?php
lmb_require('src/model/User.class.php');

class odExportHelper
{
  protected $current_user;

  function __construct(User $current_user = null)
  {
    $this->current_user = $current_user;
  }

  ############### Day ###############
  function exportDay(Day $day)
  {
    $exported_day = $this->exportDayItems([$day])[0];
    $is_owner = $this->current_user && $this->current_user->id && $this->current_user->id == $day->user_id;

    $exported_day->moments  = $this->exportMomentItems($day->getMoments());

    $comments = $day->getComments();
    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    $exported_day->comments = $this->exportDayCommentItems($comments);

    $exported_day->final_description = $day->final_description;

    if($this->current_user && !$is_owner)
    {
      $liked_day = lmbDBAL::selectQuery('day_like')
      ->addField('day_id')
      ->addCriteria(lmbSQLCriteria::equal('user_id', $this->current_user->id))
      ->addCriteria(lmbSQLCriteria::equal('day_id', $day->id))
      ->fetch()->toFlatArray();
      $liked_day = lmbArrayHelper::getColumnValues('day_id', $liked_day);
      $exported_day->is_liked = in_array($day->id, $liked_day);
    }

    return $exported_day;
  }

  function exportDaySubentity(Day $day)
  {
    $exported = $day->exportForApi();
    unset($exported->final_description);

    $this->attachUserSubentityToExport($day->getUser(), $exported);

    return $exported;
  }

  function exportDayItems($days)
  {
    if(!count($days))
      return [];

    $days_ids = lmbArrayHelper::getColumnValues('id', $days);

    $likes_count = lmbDBAL::selectQuery('day_like')
      ->addField('day_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('day_id')
      ->addCriteria(lmbSQLCriteria::in('day_id', $days_ids))
      ->fetch()->toFlatArray();
    $likes_count = lmbArrayHelper::makeKeysFromColumnValues('day_id', $likes_count);

    $comments_count = lmbDBAL::selectQuery('day_comment')
      ->addField('day_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('day_id')
      ->addCriteria(lmbSQLCriteria::in('day_id', $days_ids))
      ->fetch()->toFlatArray();
    $comments_count = lmbArrayHelper::makeKeysFromColumnValues('day_id', $comments_count);

    $day_users_ids = lmbArrayHelper::getColumnValues('user_id', $days);
    $day_users = User::findByIds($day_users_ids);
    $day_users = lmbArrayHelper::makeKeysFromColumnValues('id', $day_users);

    if($this->current_user)
    {
      lmb_assert_true($this->current_user->id);
      $favorite_days_ids = lmbDBAL::selectQuery('day_favorite')
        ->addField('day_id')
        ->addCriteria(lmbSQLCriteria::equal('user_id', $this->current_user->id))
        ->fetch()->toFlatArray();
      $favorite_days_ids = lmbArrayHelper::getColumnValues('day_id', $favorite_days_ids);
    }

    $exported = [];
    foreach ($days as $day)
    {
      $exported_day = $day->exportForApi();
      $exported_day->user = $day_users[$day->user_id]->exportForApi();
      unset($exported_day->user_id);

      if($this->current_user)
      {
        $exported_day->is_favorite = in_array($day->id, $favorite_days_ids);

        if($this->current_user->id == $day->getUser()->id)
          $exported_day->is_deleted = (bool) $day->getIsDeleted();
      }

      $exported_day->likes_count =
        isset($likes_count[$day->id]) ? $likes_count[$day->id]['count'] : 0;
      $exported_day->comments_count =
        isset($comments_count[$day->id]) ? $comments_count[$day->id]['count'] : 0;

      $exported[] = $exported_day;
    }

    return $exported;
  }

  ############### User ###############
  function exportUser(User $user)
  {
    $exported = $user->exportForApi();

    $exported->days_count = (int) $user->getDays()->count();

    $favorite_days_count = lmbDBAL::selectQuery('day_favorite')
      ->addRawField('COUNT(*)', 'count')
      ->addCriteria(lmbSQLCriteria::equal('user_id', $user->id))
      ->fetch()->toFlatArray();

    $exported->favorites_count = (int) $favorite_days_count[0]['count'];

    $following_and_followers = lmbDBAL::selectQuery('user_following')
      ->addField('user_id')
      ->addField('follower_user_id')
      ->addCriteria(
          lmbSQLCriteria::equal('user_id', $user->id)
            ->addOr(lmbSQLCriteria::equal('follower_user_id', $user->id))
      )
      ->fetch()->toFlatArray();

    $exported->followers_count = 0;
    $exported->following_count = 0;
    $exported->following = false;

    $is_owner = $this->current_user && $this->current_user->id == $user->id;

    foreach($following_and_followers as $ff)
    {
      if($user->id == $ff['user_id'])
        $exported->followers_count++;

      if($user->id == $ff['follower_user_id'])
        $exported->following_count++;

      if($this->current_user && !$is_owner && !$exported->following)
        if($user->id == $ff['follower_user_id'] && $this->current_user->id == $ff['user_id'])
          $exported->following = true;
    }

    if($is_owner)
      $exported->email = $user->getEmail();

    return $exported;
  }

  function exportUserItem(User $user)
  {
    $exported = $this->exportUserSubentity($user);

    if($this->current_user && $this->current_user->getId() != $user->getId())
      $exported->following = (bool) UserFollowing::isUserFollowUser($user, $this->current_user);

    return $exported;
  }

  function exportUserSubentity(User $user)
  {
    $exported = $user->exportForApi();

    unset($exported->birthday);

    return $exported;
  }

  function exportUserItems($users)
  {
    $following = [];
    if($me = $this->current_user)
      $following = UserFollowing::isUsersFollowUser($users, $me);

    $exported = [];
    foreach($users as $followed)
    {
      $export = $this->exportUserItem($followed);

      if(count($following))
        $export->following = (bool) $following[$followed->getId()];

      $exported[] = $export;
    }

    return $exported;
  }

  function attachUserSubentityToExport(User $user, stdClass $exported)
  {
    $exported->user = $this->exportUserItems([$user])[0];
    unset($exported->user_id);
  }

  function exportFacebookUserItems(array $facebook_users)
  {
    $exported_list = [];
    $users = User::findByFacebookUid(lmbArrayHelper::getColumnValues('facebook_uid', $facebook_users));
    $users = lmbArrayHelper::makeKeysFromColumnValues('facebook_uid', $users);

    foreach($facebook_users as $facebook_user)
    {
      $exported            = new stdClass;
      $exported->uid       = $facebook_user['facebook_uid'];
      $exported->name      = $facebook_user['name'];
      $exported->image_50  = $facebook_user['pic'];
      $exported->image_150 = $facebook_user['pic_big'];

      if(isset($users[$exported->uid]))
      {
        $user = $users[$exported->uid];
        $exported->user = $user->exportForApi();
        if($this->current_user)
          $exported->user->following = UserFollowing::isUserFollowUser($this->current_user, $user);
      }
      else
        $exported->user = null;

      $exported_list[] = $exported;
    }
    return $exported_list;
  }

  ############### Moment ###############
  function exportMoment(Moment $moment)
  {
    return $this->exportMomentSubentity($moment);
  }

  function exportMomentItem(Moment $moment)
  {
    return $this->exportMomentSubentity($moment);
  }

  function exportMomentSubentity(Moment $moment)
  {
    $exported = $moment->exportForApi();

    unset($exported->day_id);

    $exported->likes_count    = (int) $moment->getLikes()->count();
    $exported->comments_count = (int) $moment->getComments()->count();

    return $exported;
  }

  function exportMomentItems($moments)
  {
    if(!count($moments))
      return [];

    $moments_ids = lmbArrayHelper::getColumnValues('id', $moments);

    $likes_count = lmbDBAL::selectQuery('moment_like')
      ->addField('moment_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('moment_id')
      ->addCriteria(lmbSQLCriteria::in('moment_id', $moments_ids))
      ->fetch()->toFlatArray();
    $likes_count = lmbArrayHelper::makeKeysFromColumnValues('moment_id', $likes_count);

    $comments_count = lmbDBAL::selectQuery('moment_comment')
      ->addField('moment_id')
      ->addRawField('COUNT(id)', 'count')
      ->addGroupBy('moment_id')
      ->addCriteria(lmbSQLCriteria::in('moment_id', $moments_ids))
      ->fetch()->toFlatArray();
    $comments_count = lmbArrayHelper::makeKeysFromColumnValues('moment_id', $comments_count);

    $result = [];
    foreach($moments as $moment)
    {
      $exported_moment = $moment->exportForApi();
      unset($exported_moment->day_id);
      $exported_moment->likes_count = isset($likes_count[$moment->id]) ? $likes_count[$moment->id]['count'] : 0;
      $exported_moment->comments_count = isset($comments_count[$moment->id]) ? $comments_count[$moment->id]['count'] : 0;

      $result[] = $exported_moment;
    }

    return $result;
  }

  ############### Comments ###############
  protected function exportComment($comment)
  {
    $exported = $comment->exportForApi();

    $this->attachUserSubentityToExport(User::findById($comment->user_id), $exported);

    return $exported;
  }

  ################ > DayComments ###############
  function exportDayComment(DayComment $comment)
  {
    return $this->exportDayCommentItem($comment);
  }

  function exportDayCommentItem(DayComment $comment)
  {
    return $this->exportDayCommentSubentity($comment);
  }

  function exportDayCommentSubentity(DayComment $comment)
  {
    $exported = $this->exportComment($comment);

    unset($exported->day_id);

    return $exported;
  }

  function exportDayCommentItems($comments)
  {
    $exported = [];
    foreach ($comments as $comment) {
      $exported[] = $this->exportDayCommentItem($comment);
    }
    return $exported;
  }

  ################ > MomentComments ###############
  function exportMomentComment(MomentComment $comment)
  {
    return $this->exportMomentCommentItem($comment);
  }

  function exportMomentCommentItem(MomentComment $comment)
  {
    return $this->exportMomentCommentSubentity($comment);
  }

  function exportMomentCommentSubentity(MomentComment $comment)
  {
    $exported = $this->exportComment($comment);

    unset($exported->moment_id);

    return $exported;
  }

  function exportMomentCommentItems($comments)
  {
    $exported = [];
    foreach ($comments as $comment) {
      $exported[] = $this->exportMomentCommentItem($comment);
    }
    return $exported;
  }

  ############### News ###############
  ################ > News ###############
  function exportNewsListItem(News $news)
  {
    $exported = $news->exportForApi();

    if ($news->getSender())
      $this->attachUserSubentityToExport($news->getSender(), $exported);

    // if($news->getDay())
    //   $exported->day    = $this->exportDaySubentity($news->getDay());
    // elseif($news->getMoment()) {
    //   $exported->day    = $this->exportDaySubentity($news->getMoment()->getDay());
    //   $exported->moment = $this->exportMomentSubentity($news->getMoment());
    //   unset($exported->moment->day_id);
    // }

    // unset($exported->day_id);
    // unset($exported->moment_id);
    // unset($exported->day_comment_id);
    // unset($exported->moment_comment_id);
    // unset($exported->day_like_id);
    // unset($exported->moment_like_id);

    return $exported;
  }

  function exportNewsItems($news)
  {
    $exported = [];
    foreach ($news as $news_item) {
      $exported[] = $this->exportNewsListItem($news_item);
    }
    return $exported;
  }

  ################ > Activity ###############
  function exportActivityListItem(News $activity)
  {
    return $this->exportNewsListItem($activity);
  }

  function exportActivityItems($activities)
  {
    $exported = [];
    foreach ($activities as $activity) {
      $exported[] = $this->exportActivityListItem($activity);
    }
    return $exported;
  }

  ############### Complain ###############
  function exportComplaint(Complaint $complaint)
  {
    return $this->exportComplaintSubentity($complaint);
  }

  function exportComplaintListItem(Complaint $complaint)
  {
    return $this->exportComplaintSubentity($complaint);
  }

  function exportComplaintSubentity(Complaint $complaint)
  {
    return $complaint->exportForApi();
  }

  function exportComplaintItems($complaints)
  {
    $exported = [];
    foreach ($complaints as $complaint) {
      $exported[] = $this->exportComplaintListItem($complaint);
    }
    return $exported;
  }
}
