<?php
class odExportHelper
{
  ############### Day ###############
  function exportDay(Day $day)
  {
    $exported = $this->exportDayItem($day);

    $exported->moments  = $this->exportMomentItems($day->getMoments());

    $comments = $day->getComments();
    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    $exported->comments = $this->exportDayCommentItems($comments);

    $exported->final_description = $day->getFinalDescription();

    return $exported;
  }

  function exportDayItem(Day $day)
  {
    $exported = $this->exportDaySubentity($day);

    if($current_user = lmbToolkit::instance()->getUser()) {
      $exported->is_favorite = (bool) DayFavorite::isFavorited($current_user, $day);

      if($current_user->getId() == $day->getUser()->getId())
        $exported->is_deleted = (bool) $day->getIsDeleted();
    }

    $exported->likes_count    = (int) $day->getLikes()->count();
    $exported->comments_count = (int) $day->getComments()->count();

    return $exported;
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
    $exported = [];
    foreach ($days as $day) {
      $exported[] = $this->exportDayItem($day);
    }
    return $exported;
  }

  ############### > Interesting ###############
  function exportDayInterestingItem(DayInterestRecord $day_rating)
  {
    return $this->exportDayItem($day_rating->getDay());
  }

  function exportDayInterestingItems($day_ratings)
  {
    $exported = [];
    foreach ($day_ratings as $day_rating) {
      $exported[] = $this->exportDayInterestingItem($day_rating);
    }
    return $exported;
  }

  ############### User ###############
  function exportUser(User $user)
  {
    $exported = $user->exportForApi();

    $exported->days_count       = (int) $user->getDays()->count();
    $exported->favorites_count = (int) $user->getFavoriteDays()->count();
    $exported->followers_count  = (int) $user->getFollowers()->count();
    $exported->following_count  = (int) $user->getFollowing()->count();

    if($current_user = lmbToolkit::instance()->getUser()) {
      if($current_user->getId() == $user->getId())
        $exported->email        = $user->getEmail();
      else
        $exported->following = (bool) UserFollowing::isUserFollowUser($user, $current_user);
    }

    return $exported;
  }

  function exportUserItem(User $user)
  {
    $exported = $this->exportUserSubentity($user);

    $current_user = lmbToolkit::instance()->getUser();
    if($current_user && $current_user->getId() != $user->getId())
      $exported->following = (bool) UserFollowing::isUserFollowUser($user, $current_user);

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
    if($me = lmbToolkit::instance()->getUser())
      $following = UserFollowing::isUsersFollowUser($users, $me);

    $exported = [];
    foreach($users as $followed) {
      $export = $this->exportUserItem($followed);

      if(count($following))
        $export->following = (bool) $following[$followed->getId()];

      $exported[] = $export;
    }

    return $exported;
  }

  function attachUserSubentityToExport(User $user, stdClass $exported)
  {
    $exported->user = $this->exportUserItem($user);
    unset($exported->user_id);
  }

  ############### > FacebookUser ###############
  function exportFacebookUserItem(array $facebook_user)
  {
    $exported            = new stdClass;
    $exported->uid       = $facebook_user['facebook_uid'];
    $exported->name      = $facebook_user['name'];
    $exported->image_50  = $facebook_user['pic'];
    $exported->image_150 = $facebook_user['pic_big'];

    if($user = User::findByFacebookUid($exported->uid))
    {
      $exported->user = $user->exportForApi();
      $exported->user->following = UserFollowing::isUserFollowUser(lmbToolkit::instance()->getUser(), $user);
    }
    else
      $exported->user = null;

    return $exported;
  }

  function exportFacebookUserItems(array $facebook_users)
  {
    $exported = [];
    foreach($facebook_users as $facebook_user) {
      $exported[] = $this->exportFacebookUserItem($facebook_user);
    }
    return $exported;
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
    $exported = [];
    foreach($moments as $moment) {
      $exported[] = $this->exportMomentItem($moment);
    }
    return $exported;
  }

  ############### Comments ###############
  protected function exportComment(BaseComment $comment)
  {
    $exported = $comment->exportForApi();

    $this->attachUserSubentityToExport($comment->getUser(), $exported);

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
