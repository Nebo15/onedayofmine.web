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

    return $exported;
  }

  function exportDayItem(Day $day)
  {
    $exported = $this->exportDaySubentity($day);

    if($current_user = lmbToolkit::instance()->getUser()) {
      $exported->is_favourite = DayFavourite::isFavourited($current_user, $day);

      if($current_user->getId() == $day->getUser()->getId())
        $exported->is_deleted = $day->getIsDeleted();
    }

    $exported->likes_count    = $day->getLikes()->count();
    $exported->comments_count = $day->getComments()->count();

    return $exported;
  }

  function exportDaySubentity(Day $day)
  {
    $exported = $day->exportForApi();

    $this->attachUserSubentityToExport($day->getUser(), $exported);

    return $exported;
  }

  function exportDayItems(lmbCollectionInterface $days)
  {
    $exported = [];
    foreach ($days as $day) {
      $exported[] = $this->exportDayItem($day);
    }
    return $exported;
  }

  function exportDayItems_forOwner(lmbCollectionInterface $days)
  {
    return $this->exportDayItems($days);
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

    $exported->days_count       = $user->getDays()->count();
    $exported->favourites_count = $user->getFavouriteDays()->count();
    $exported->followers_count  = $user->getFollowers()->count();
    $exported->following_count  = $user->getFollowing()->count();

    if($current_user = lmbToolkit::instance()->getUser()) {
      if($current_user->getId() == $user->getId())
        $exported->email        = $user->getEmail();
      else
        $exported->following = UserFollowing::isUserFollowUser($user, $current_user);
    }

    return $exported;
  }

  function exportUserItem(User $user)
  {
    $exported = $this->exportUserSubentity($user);

    if(lmbToolkit::instance()->getUser())
      $exported->following = UserFollowing::isUserFollowUser($user, lmbToolkit::instance()->getUser());

    return $exported;
  }

  function exportUserSubentity(User $user)
  {
    $exported = $user->exportForApi();

    unset($exported->birthday);

    return $exported;
  }

  function exportUserItems(lmbCollectionInterface $users)
  {
    $following = [];
    if($me = lmbToolkit::instance()->getUser())
      $following = UserFollowing::isUsersFollowUser($users, $me);

    $exported = [];
    foreach($users as $followed) {
      $export = $this->exportUserItem($followed);

      if(count($following))
        $export->following = $following[$followed->getId()];

      $exported[] = $export;
    }

    return $exported;
  }

  function attachUserSubentityToExport(User $user, stdClass $exported)
  {
    $exported->user = $this->exportUserItem($user);
    unset($exported->user_id);
  }

  ############### Moment ###############
  function exportMoment(Moment $moment)
  {
    return $this->exportMomentItem($moment);
  }

  function exportMomentItem(Moment $moment)
  {
    return $this->exportMomentSubentity($moment);
  }

  function exportMomentSubentity(Moment $moment)
  {
    $exported = $moment->exportForApi();

    unset($exported->day_id);

    $exported->likes_count    = $moment->getLikes()->count();
    $exported->comments_count = $moment->getComments()->count();

    return $exported;
  }

  function exportMomentItems(lmbCollectionInterface $moments)
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

  function exportDayCommentItems(lmbCollectionInterface $comments)
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

  function exportMomentCommentItems(lmbCollectionInterface $comments)
  {
    $exported = [];
    foreach ($comments as $comment) {
      $exported[] = $this->exportMomentCommentItem($comment);
    }
    return $exported;
  }

  ############### News ###############
  ################ > News ###############
  function exportNewsItem(News $news)
  {
    $exported = $news->exportForApi();

    if ($news->getSender())
      $this->attachUserSubentityToExport($news->getSender(), $exported);

    if($news->getDay())
      $exported->day    = $this->exportDaySubentity($news->getDay());
    elseif($news->getMoment()) {
      $exported->day    = $this->exportDaySubentity($news->getMoment()->getDay());
      $exported->moment = $this->exportMomentSubentity($news->getMoment());
      unset($exported->moment->day_id);
    }

    unset($exported->day_id);
    unset($exported->moment_id);
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
      $exported[] = $this->exportNewsItem($news_item);
    }
    return $exported;
  }

  ################ > Activity ###############
  function exportActivityItem(News $activity)
  {
    return $activity->exportForApi();
  }

  function exportActivityItems($activities)
  {
    $exported = [];
    foreach ($activities as $activity) {
      $exported[] = $this->exportActivityItem($activity);
    }
    return $exported;
  }

  ############### Complain ###############
  function exportComplaint(Complaint $complaint)
  {
    return $complaint->exportForApi();
  }
}
