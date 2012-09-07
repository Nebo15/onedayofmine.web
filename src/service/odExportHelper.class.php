<?php
class odExportHelper
{
  function exportDay(Day $day)
  {
    $exported = $day->exportForApi();
    $this->attachUser($day, $exported);
    $this->attachIsFavourited($day, $exported);
    $this->attachLikesCount($day, $exported);
    $this->attachCommentsCount($day, $exported);
    return $exported;
  }

  function exportFullDay(Day $day)
  {
    $exported = $this->exportDay($day);
    $this->attachComments($day, $exported);
    $this->attachMoments($day, $exported);
    return $exported;
  }

  function exportDays(lmbCollectionInterface $days)
  {
    $exported = array();
    foreach ($days as $day) {
      $exported[] = $this->exportDay($day);
    }
    return $exported;
  }

  function exportMoment(Moment $moment)
  {
    $exported = $moment->exportForApi();
    $this->attachCommentsCount($moment, $exported);
    $this->attachLikesCount($moment, $exported);
    return $exported;
  }

  function exportMoments(lmbCollectionInterface $moments)
  {
    $exported = [];
    foreach($moments as $moment) {
      $moment_exported = $this->exportMoment($moment);
      unset($moment_exported->day_id);
      $exported[] = $moment_exported;
    }
    return $exported;
  }

  function attachMoments(Day $day, stdClass $exported)
  {
    $exported->moments = $this->exportMoments($day->getMoments());
  }

  function exportDayComment(DayComment $comment)
  {
    $exported = $comment->exportForApi();
    $exported->user = $comment->getUser()->exportForApi();
    unset($exported->day_id);
    unset($exported->user_id);
    return $exported;
  }

  function exportDayComments(Day $day)
  {
    $comments = $day->getComments();
    $exported = [];
    foreach ($comments as $comment) {
      $exported[] = $this->exportDayComment($comment);
    }
    return $exported;
  }

  function attachComments(Day $day, stdClass $exported)
  {
    $comments = $day->getComments();
    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);

    $this->attachCommentsCount($day, $exported);

    $exported->comments = $this->exportDayComments($day);
  }

  function exportMomentComment(MomentComment $comment)
  {
    $exported = $comment->exportForApi();
    $exported->user = $comment->getUser()->exportForApi();
    unset($exported->moment_id);
    unset($exported->user_id);
    return $exported;
  }

  function exportMomentComments(Moment $comment)
  {
    $comments = $day->getComments();
    $exported = [];
    foreach ($comments as $comment) {
      $exported[] = $this->exportMomentComment($comment);
    }
    return $exported;
  }

  function exportUser(User $user)
  {
    return $user->exportForApi();
  }

  function attachUser(BaseModel $userable, stdClass $exported)
  {
    $exported->user = $userable->getUser()->exportForApi();
    unset($exported->user_id);
  }

  function attachCommentsCount(BaseModel $commentable, stdClass $exported)
  {
    $exported->comments_count = $commentable->getComments()->count();
  }

  function attachLikesCount(BaseModel $likeable, stdClass $exported)
  {
    $exported->likes_count = $likeable->getLikes()->count();
  }

  function attachIsFavourited(Day $day, stdClass $exported)
  {
    if(!$user = lmbToolkit::instance()->getUser())
      return null;

    $exported->is_favourite = DayFavourite::isFavourited($user, $day);
  }

  function attachIsDeleted(BaseModel $day_or_moment, stdClass $exported)
  {
    if(!lmbToolkit::instance()->getUser())
      return null;

    if(lmbToolkit::instance()->getUser()->getId() != $day_or_moment->getUser()->getId())
      return null;

    $exported->is_deleted = $day_or_moment->getIsDeleted();
  }
}
