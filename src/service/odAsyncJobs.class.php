<?php

class odAsyncJobs
{
  static function _userCreate($user_id)
  {
    if(!$user = User::findById($user_id))
	    throw new lmbException('User with id='.$user_id.' not found');
    self::toolkit()->getNewsObserver()->onUserRegister($user);
  }

	static function _userFollow($user_id)
  {
    $user = User::findById($user_id);
    self::toolkit()->getNewsObserver()->onFollow($user);
  }

	static function _shareDayStart($day_id)
  {
    $day = Day::findById($day_id);
    self::toolkit()->getNewsObserver()->onDay($day);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getFacebookProfile()->shareDayBegin($day);
    self::toolkit()->getTwitterProfile()->shareDayBegin($day);
  }

	static function _shareDayEnd($day_id)
  {
    $day = Day::findById($day_id);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getFacebookProfile()->shareDayEnd($day);
    self::toolkit()->getTwitterProfile()->shareDayEnd($day);
  }

	static function _shareDay($day_id)
  {
    $day = Day::findById($day_id);
    self::toolkit()->getFacebookProfile()->shareDay($day);
    self::toolkit()->getTwitterProfile()->shareDay($day);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getNewsObserver()->onDayShare($day);
  }

	static function _dayLike($day_id, $like_id)
  {
    $day = Day::findById($day_id);
    $like = DayLike::findById($like_id);
    self::toolkit()->getFacebookProfile()->shareDayLike($day, $like);
    self::toolkit()->getTwitterProfile()->shareDayLike($day, $like);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getNewsObserver()->onDayLike($day, $like);
  }

	static function _dayUnlike($day_id, $like_id)
  {
    $day = Day::findById($day_id);
    $like = DayLike::findById($like_id);
    self::toolkit()->getFacebookProfile()->shareDayUnlike($day, $like);
    self::toolkit()->getTwitterProfile()->shareDayUnlike($day, $like);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getNewsObserver()->onDayUnlike($day, $like);
  }

	static function _dayCommentCreate($comment_id)
  {
    $comment = DayComment::findById($comment_id);
    self::toolkit()->getNewsObserver()->onDayComment($comment);
  }

	static function _dayCommentDelete($comment_id)
  {
    $comment = DayComment::findById($comment_id);
    self::toolkit()->getNewsObserver()->onDayCommentDelete($comment);
  }

	static function _dayDelete($day_id)
  {
    $day = Day::findById($day_id);
    self::toolkit()->getNewsObserver()->onDayDelete($day);
  }

	static function _dayRestore($day_id)
  {
    $day = Day::findById($day_id);
    self::toolkit()->getNewsObserver()->onDayRestore($day);
  }

	static function _momentCreate($moment_id)
  {
    $moment = Moment::findById($moment_id);
    self::toolkit()->getNewsObserver()->onMoment($moment);
  }

	static function _momentDelete($moment_id)
  {
    $moment = Moment::findById($moment_id);
    self::toolkit()->getNewsObserver()->onMomentDelete($moment);
  }

	static function _momentRestore($moment_id)
  {
    $moment = Moment::findById($moment_id);
    self::toolkit()->getNewsObserver()->onMomentRestore($moment);
  }

	static function _momentLike($moment_id, $like_id)
  {
    $moment = Moment::findById($moment_id);
    $like = MomentLike::findById($like_id);
    self::toolkit()->getFacebookProfile()->shareMomentLike($moment, $like);
    self::toolkit()->getTwitterProfile()->shareMomentLike($moment, $like);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getNewsObserver()->onMomentLike($moment, $like);
  }

	static function _momentUnlike($moment_id, $like_id)
  {
    lmb_assert_true($moment = Moment::findById($moment_id));
    lmb_assert_true($like = MomentLike::findById($like_id));
    self::toolkit()->getFacebookProfile()->shareMomentUnlike($moment, $like);
    self::toolkit()->getTwitterProfile()->shareMomentUnlike($moment, $like);
//    $this->job->sendStatus(1, 2);
    self::toolkit()->getNewsObserver()->onMomentUnlike($moment, $like);
  }

	static function _momentCommentCreate($comment_id)
  {
    $comment = MomentComment::findById($comment_id);
    self::toolkit()->getNewsObserver()->onMomentComment($comment);
  }

	static function _momentCommentDelete($comment_id)
  {
    lmb_assert_true($comment = MomentComment::findById($comment_id));
    self::toolkit()->getNewsObserver()->onMomentCommentDelete($comment);
  }

	static function _facebookInvite($user_id, $uid)
  {
    $user = User::findById($user_id);
    $profile = self::toolkit()->getFacebookProfile($user);
    $profile->shareInvitation($uid);
  }

	static function _emailInvite($email, $name)
  {
    $text =<<<EOD
Hello!

Your friend %name% wants you to become part of One Day of Mine community, where you can find out how another people live their days and share same information about you.
EOD;

    $text = str_replace('%name%', $name, $text);
    self::toolkit()->getMailer()
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

  /**
   * @return odTools
   */
  static function toolkit()
  {
    return lmbToolkit::instance();
  }
}
