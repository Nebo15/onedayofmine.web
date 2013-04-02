<?php
lmb_require('src/model/DeviceToken.class.php');
lmb_require('src/model/News.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');
lmb_require('src/model/DayComment.class.php');
lmb_require('src/model/MomentComment.class.php');

/**
 * News creator.
 */
class odNewsService
{
  /*
   * Messages text description.
   *
   * @todo move this to lang file
   */
  ## Day ##
  const MSG_DAY_CREATED         = "{sender} just created day {day}";
  const MSG_DAY_COMMENT         = "{sender} has responded you in day {day}";
  const MSG_DAY_LIKED           = "{sender} liked day {day}";
  const MSG_DAY_SHARE           = "{sender} share day {day}";
  const MSG_DAY_FAVORITE        = "{sender} added the day {day} to favorites";
	const MSG_DAY_GATHERING       = "{sender} need your help! Add moments to day {day}";

  ## Moment ##
  const MSG_MOMENT_CREATED      = "{sender} created moment in day {day}";
  const MSG_MOMENT_COMMENT      = "{sender} has responded you in moment of day {day}";
  const MSG_MOMENT_LIKED        = "{sender} liked moment in day {day}";

  ## Follow ##
  const MSG_FOLLOW              = "{sender} started to follow {user}";

  ## User ##
  const MSG_FBFRIEND_REGISTERED = "You'r facebook friend '{sender}' just started to use this application, follow hem?";

  /**
   * @var User
   */
  protected $sender;

  protected $recipients = array();

  public function __construct(User $sender)
  {
    $this->sender = $sender;
  }

  /**
   * @param User $user
   */
  function onUserRegister(User $user)
  {
    $profile = lmbToolkit::instance()->getFacebookProfile($user);

    $this->addRecipients($profile->getRegisteredFriends());

    $news = (new News)->import([
      'link' => "odom://user/{$user->id}"
    ]);

    $this->send($news, self::MSG_FBFRIEND_REGISTERED);
  }

  /**
   * @param User $followed_user
   */
  function onFollow(User $followed_user)
  {
    foreach($this->sender->getFollowersUsers() as $recipient)
    {
      if($recipient->id != $followed_user->id)
        if(1 == $recipient->getSettings()->notifications_related_activity)
          $this->addRecipient($recipient);
    }
    $this->addRecipient($followed_user);

    $news = (new News)->import([
      'user_id' => $followed_user->id,
      'link' => "odom://user/{$followed_user->id}"
    ]);
    $this->send($news, self::MSG_FOLLOW, ['user' => $followed_user]);
  }

  /**
   * @param Day $day
   */
  function onDay(Day $day)
  {
    lmb_assert_true($day->id);
    $news = (new News)->import([
      'user_id' => $this->sender->id,
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);
    foreach($this->sender->getFollowersUsers() as $follower)
    {
      if(1 == $follower->getSettings()->notifications_new_days)
        $this->addRecipient($follower);
    }
    $this->send($news, self::MSG_DAY_CREATED, ['day' => $day]);
  }

  function onDayDelete(Day $day)
  {
    lmb_assert_true($day->id);
    News::delete('day_id='.$day->id);
  }

  // TODO
  function onDayRestore(Day $day) {}

  function onDayShare(Day $day)
  {
    lmb_assert_true($day->id);
    $news = (new News())->import([
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);
    $user = User::findById($day->user_id);
    if(1 == $user->getSettings()->notifications_related_activity)
      $this->addRecipient($user);
    $this->send($news, self::MSG_DAY_SHARE, ['day' => $day]);
  }

  function onDayFavorite(Day $day)
  {
    lmb_assert_true($day->id);
    $news = (new News)->import([
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);

    if(1 == User::findById($day->user_id)->getSettings()->notifications_related_activity)
      $this->addRecipient($day->getUser());

    foreach($this->sender->getFollowersUsers() as $follower)
      if(1 == $follower->getSettings()->notifications_related_activity)
        $this->addRecipient($follower);

    $this->send($news, self::MSG_DAY_FAVORITE, ['day' => $day]);
  }

	function onDayEnableGathering(Day $day)
	{
		lmb_assert_true($day->id);
		$news = (new News)->import([
			'day_id' => $day->id,
			'link' => "odom://day/{$day->id}"
		]);

		foreach($this->sender->getFollowersUsers() as $follower)
			if(1 == $follower->getSettings()->notifications_related_activity)
				$this->addRecipient($follower);

		$this->send($news, self::MSG_DAY_GATHERING, ['day' => $day]);
	}

  /**
   * @param Moment $moment
   */
  function onMoment(Moment $moment)
  {
    lmb_assert_true($moment->id);

    $news = (new News)->import(['day_id' => $moment->day_id, 'moment_id' => $moment->id]);

    foreach($this->sender->getFollowersUsers() as $follower)
      if(1 == $follower->getSettings()->notifications_new_days)
        $this->addRecipient($follower);

    $this->send($news, self::MSG_MOMENT_CREATED, ['day' => $moment->getDay()]);
  }

  function onMomentDelete(Moment $moment)
  {
    lmb_assert_true($moment->id);
    News::delete('moment_id='.((int) $moment->id));
  }

  // TODO
  function onMomentRestore(Moment $moment) {}

  function onDayLike(Day $day, DayLike $like)
  {
    lmb_assert_true($day->id);
    $news = (new News)->import([
      'day_id' => $day->id,
      'day_like_id' => $like->id,
      'link' => "odom://day/{$day->id}"
    ]);
    $owner = $day->getUser();

    if($owner->getSettings()->notifications_related_activity)
      $this->addRecipient($owner);

    foreach($this->sender->getFollowersUsers() as $follower)
      if(1 == $follower->getSettings()->notifications_related_activity)
        $this->addRecipient($follower);

    $this->send($news, self::MSG_DAY_LIKED, ['day' => $day]);
  }

  function onDayUnlike(Day $day, DayLike $like)
  {
    lmb_assert_true($like->id);
    News::delete('day_like_id='.$like->id);
  }

  function onMomentLike(Moment $moment, MomentLike $like)
  {
    lmb_assert_true($moment->id);
    $news = (new News)->import([
      'day_id' => $moment->day_id,
      'moment_id' => $moment->id,
      'moment_like_id' => $like->id,
      'link' => "odom://moment/{$moment->id}"
    ]);
    $day = $moment->getDay();
    $owner = $moment->getDay()->getUser();

    if($owner->getSettings()->notifications_related_activity)
      $this->addRecipient($owner);

    foreach($this->sender->getFollowersUsers() as $follower)
      if(1 == $follower->getSettings()->notifications_related_activity)
        $this->addRecipient($follower);

    $this->send($news, self::MSG_MOMENT_LIKED, ['day' => $day]);
  }

  function onMomentUnlike(Moment $moment, MomentLike $like)
  {
    lmb_assert_true($like->id);
    News::delete('moment_like_id='.$like->id);
  }

  function onDayComment(DayComment $comment)
  {
    lmb_assert_true($comment->id);
    $day = Day::findById($comment->day_id);

    $news = new News;
    $news->day_comment_id = $comment->id;
    $news->day_id = $comment->day_id;
    $news->link = "odom://day/{$comment->day_id}/comment/{$comment->id}";

    $user = User::findById($day->user_id);
    if(1 == $user->getSettings()->notifications_new_comments)
      $this->addRecipient($user);

    foreach ($day->getComments() as $day_comment)
    {
      $comment_author = User::findById($day_comment->user_id);
      if($this->sender->id != $comment_author->id)
        if(1 == $comment_author->getSettings()->notifications_new_replays)
          $this->addRecipient($comment_author);
    }

    $this->send($news, self::MSG_DAY_COMMENT, ['day' => $day]);
  }

  function onDayCommentDelete(DayComment $comment)
  {
    lmb_assert_true($comment->id);
    News::delete('day_comment_id='.$comment->id);
  }

  function onMomentComment(MomentComment $comment)
  {
    lmb_assert_true($comment->id);
    $moment = Moment::findById($comment->moment_id);
    $day    = Day::findById($moment->day_id);

    $news = new News;
    $news->moment_id = $moment->id;
    $news->moment_comment_id = $comment->id;
    $news->day_id = $day->id;
    $news->link = "odom://moment/{$moment->id}/comment/{$comment->id}";

    $day_owner = User::findById($day->user_id);
    if(1 == $day_owner->getSettings()->notifications_new_comments)
      $this->addRecipient(User::findById($day->user_id));

    foreach ($moment->getComments() as $moment_comment)
    {
      $comment_author = User::findById($moment_comment->user_id);
      if($this->sender->id != $comment_author->id)
        if(1 == $comment_author->getSettings()->notifications_new_replays)
          $this->addRecipient($comment_author);
    }

    $this->send($news, self::MSG_MOMENT_COMMENT, ['day' => $day]);
  }

  function onMomentCommentDelete(MomentComment $comment)
  {
    lmb_assert_true($comment->id);
    News::delete('moment_comment_id='.$comment->id);
  }

  /**
   * Apply message with text $text to news $news. You can specify additional text $params.
   *
   * @param  News  $news
   * @param  int   $type   One of {@see odNewsService::MSG_*} constants. Notice: type is text-string right now.
   * @param  array $params
   * @return void
   */
  public function applyText(News $news, $type, array $params = array())
  {
    lmb_assert_type($type, 'string');
    $news->text = self::getMessage($type, $params);
  }

  /**
   * Returns message based on it's $type and $params.
   *
   * @param  string $type      One of {@see odNewsService::MSG_*} constants. Notice: type is text-string right now.
   * @param  array  $params
   * @return string
   */
  public static function getMessage($tpl, array $params = array())
  {
    if(false !== strpos($tpl, '{sender}'))
    {
      if(!isset($params['sender']))
        throw new lmbException('sender not found in params');
      $tpl = str_replace('{sender}', "<a href=\"odom://users/{$params['sender']->id}\">{$params['sender']->name}</a>", $tpl);
    }
    if(false !== strpos($tpl, '{user}'))
    {
      if(!isset($params['user']))
        throw new lmbException('user not found in params');
      $tpl = str_replace('{user}', "<a href=\"odom://users/{$params['user']->id}\">{$params['user']->name}</a>", $tpl);
    }
    if(false !== strpos($tpl, '{day}'))
    {
      if(!isset($params['day']))
        throw new lmbException('day not found in params');
      $tpl = str_replace('{day}', "<a href=\"odom://days/{$params['day']->id}\">{$params['day']->title}</a>", $tpl);
    }
    return $tpl;
  }

  /**
   * Send $news to all $recipients.
   *
   * @param  News                   $news
   * @param  lmbCollectionInterface $recipients
   */
  protected function addRecipients($recipients)
  {
    lmb_assert_type($recipients, 'array');
    foreach($recipients as $recipient) {
      $this->addRecipient($recipient);
    }
  }

  /**
   * Send $news to specified $recipient.
   *
   * @param News $news
   * @param User $recipient
   */
  protected function addRecipient(User $recipient)
  {
    lmb_assert_true($recipient->id, 'Recipient have no id');
    lmb_assert_true($this->sender->id, 'Sender have no id');
    if($recipient->id == $this->sender->id)
      return;
    $this->recipients[$recipient->id] = $recipient;
  }

  protected function send(News $news, $type, array $params = array())
  {
    $params['sender'] = $this->sender;
    $text = self::getMessage($type, $params);
    $news->setSender($this->sender);
    $news->text = $text;
    $news->save();

    foreach($this->recipients as $recipient)
    {
      $recipient_record = new NewsRecipient();
      $recipient_record->setUser($recipient);
      $recipient_record->setNews($news);
      $recipient_record->save();

	    /** @var $facebook odFacebook */
	    $facebook = lmbToolkit::instance()->getFacebook();
	    $data = [
		    'template' => $text,
		    'access_token' => $facebook->getAccessToken(),
		    'href' => '/'
			];
	    $facebook->api('/'.$recipient->facebook_uid.'/notifications', 'post', $data);
    }

    $this->_addNotifications($this->recipients, $text);

    $this->recipients = [];
  }

  protected function _addNotifications($recipients, $text)
  {
    $query = lmbDBAL::bulkInsertQuery('device_notification');

    $is_empty = true;
    foreach($recipients as $recipient)
    {
      foreach($recipient->getDeviceTokens() as $token)
      {
        $query->addSet([
          'device_token_id' => $token->id,
          'text' => $text,
          'icon' => null,
          'sound' => null,
          'is_sended' => 0
        ]);
        $is_empty = false;
      }
    }
    if(!$is_empty)
      $query->execute();
  }
}
