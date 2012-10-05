<?php

class odAsyncJobs
{
  /**
   * @var GearmanJob
   */
  public $job;

  function _userCreate($user_id)
  {
    $user = User::findById($user_id);
    lmbToolkit::instance()->getNewsObserver()->onUserRegister($user);
  }

  function _userFollow($user_id)
  {
    $user = User::findById($user_id);
    lmbToolkit::instance()->getNewsObserver()->onFollow($user);
  }

  function _shareDayStart($day_id)
  {
    $day = Day::findById($day_id);
    lmbToolkit::instance()->getNewsObserver()->onDay($day);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getPostingService()->shareDayBegin($day);
  }

  function _shareDayEnd($day_id)
  {
    $day = Day::findById($day_id);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getPostingService()->shareDayEnd($day);
  }

  function _shareDay($day_id)
  {
    $day = Day::findById($day_id);
    lmbToolkit::instance()->getPostingService()->shareDay($day);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getNewsObserver()->onDayShare($day);
  }

  function _dayLike($day_id, $like_id)
  {
    $day = Day::findById($day_id);
    $like = DayLike::findById($like_id);
    lmbToolkit::instance()->getPostingService()->shareDayLike($day, $like);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getNewsObserver()->onDayLike($day, $like);
  }

  function _dayUnlike($day_id, $like_id)
  {
    $day = Day::findById($day_id);
    $like = DayLike::findById($like_id);
    lmbToolkit::instance()->getPostingService()->shareDayUnlike($day, $like);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getNewsObserver()->onDayUnlike($day, $like);
  }

  function _dayCommentCreate($comment_id)
  {
    $comment = DayComment::findById($comment_id);
    lmbToolkit::instance()->getNewsObserver()->onDayComment($comment);
  }

  function _dayCommentDelete($comment_id)
  {
    $comment = DayComment::findById($comment_id);
    lmbToolkit::instance()->getNewsObserver()->onDayCommentDelete($comment);
  }

  function _dayDelete($day_id)
  {
    $day = Day::findById($day_id);
    lmbToolkit::instance()->getNewsObserver()->onDayDelete($day);
  }

  function _dayRestore($day_id)
  {
    $day = Day::findById($day_id);
    lmbToolkit::instance()->getNewsObserver()->onDayRestore($day);
  }

  function _momentCreate($moment_id)
  {
    $moment = Moment::findById($moment_id);
    lmbToolkit::instance()->getNewsObserver()->onMoment($moment);
  }

  function _momentDelete($moment_id)
  {
    $moment = Moment::findById($moment_id);
    lmbToolkit::instance()->getNewsObserver()->onMomentDelete($moment);
  }

  function _momentRestore($moment_id)
  {
    $moment = Moment::findById($moment_id);
    lmbToolkit::instance()->getNewsObserver()->onMomentRestore($moment);
  }

  function _momentLike($moment_id, $like_id)
  {
    $moment = Moment::findById($moment_id);
    $like = MomentLike::findById($like_id);
    lmbToolkit::instance()->getPostingService()->shareMomentLike($moment, $like);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getNewsObserver()->onMomentLike($moment, $like);
  }

  function _momentUnlike($moment_id, $like_id)
  {
    lmb_assert_true($moment = Moment::findById($moment_id));
    lmb_assert_true($like = MomentLike::findById($like_id));
    lmbToolkit::instance()->getPostingService()->shareMomentUnlike($moment, $like);
//    $this->job->sendStatus(1, 2);
    lmbToolkit::instance()->getNewsObserver()->onMomentUnlike($moment, $like);
  }

  function _momentCommentCreate($comment_id)
  {
    $comment = MomentComment::findById($comment_id);
    lmbToolkit::instance()->getNewsObserver()->onMomentComment($comment);
  }

  function _momentCommentDelete($comment_id)
  {
    lmb_assert_true($comment = MomentComment::findById($comment_id));
    lmbToolkit::instance()->getNewsObserver()->onMomentCommentDelete($comment);
  }

  function _facebookInvite($user_id, $uid)
  {
    $user = User::findById($user_id);
    $profile = lmbToolkit::instance()->getFacebookProfile($user);
    $profile->shareInvitation($uid);
  }

  function _emailInvite($email, $name)
  {
    $text =<<<EOD
Hello!

Your friend %name% wants you to become part of One Day of Mine community, where you can find out how another people live their days and share same information about you.
EOD;

    $text = str_replace('%name%', $name, $text);
    lmbToolkit::instance()->getMailer()
      ->sendPlainMail($email, 'Invitation to One Day of Mine', $text);
  }


  static function encodeWorkload($params)
  {
    return serialize($params);
  }

  static function decodeWorkload($string)
  {
    return unserialize($string);
  }

  static function __callStatic($name, $arguments)
  {
    $class = get_called_class();
    $obj = new $class;
    $obj->job = $arguments[0];
    $method_name = '_'.$name;
    $obj->$method_name(self::decodeWorkload($obj->job->workload()));
    $obj->job->sendComplete(true);
  }
}
