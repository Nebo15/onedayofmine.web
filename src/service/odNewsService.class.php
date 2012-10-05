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
  const MSG_DAY_CREATED         = '<a href="app://users/:id">%s</a> just created day <a href="app://days/:id">%s</a>';
  const MSG_DAY_COMMENT         = "%s has responded you in day %s";
  const MSG_DAY_LIKED           = "%s liked day %s";
  const MSG_DAY_SHARE           = "%s share day %s";
  const MSG_DAY_Favorite       = "%s added the day %s to favorites";

  ## Moment ##
  const MSG_MOMENT_CREATED      = "%s created moment in day %s";
  const MSG_MOMENT_COMMENT      = "%s has responded you in moment of day %s";
  const MSG_MOMENT_LIKED        = "%s liked moment in day %s";

  ## Follow ##
  const MSG_FOLLOW              = "%s started to follow %s";

  ## User ##
  const MSG_FBFRIEND_REGISTERED = "You'r facebook friend '%s' just started to use this application, follow hem?";

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

    $news = new News([
      'link' => "odom://user/{$user->id}"
    ]);

    $this->send($news, self::MSG_FBFRIEND_REGISTERED, array($user->name));
  }

  /**
   * @param User $followed_user
   */
  function onFollow(User $followed_user)
  {
    foreach($this->sender->getFollowers() as $recipient)
    {
      if($recipient->getId() != $followed_user->getId())
        if(1 == $recipient->getSettings()->getNotificationsRelatedActivity())
          $this->addRecipient($recipient);
    }
    $this->addRecipient($followed_user);

    $news = new News([
      'user_id' => $followed_user->id,
      'link' => "odom://user/{$followed_user->id}"
    ]);
    $this->send($news, self::MSG_FOLLOW, array($this->sender->name, $followed_user->name));
  }

  /**
   * @param Day $day
   */
  function onDay(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News([
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);
    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsNewDays())
        $this->addRecipient($follower);
    $this->send($news, self::MSG_DAY_CREATED, array($this->sender->getName(), $day->getTitle()));
  }

  function onDayDelete(Day $day)
  {
    lmb_assert_true($day->id);
    News::delete('day_id='.$day->getId());
  }

  // TODO
  function onDayRestore(Day $day) {}

  function onDayShare(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News([
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);
    if(1 == $day->getUser()->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($day->getUser());
    $this->send($news, self::MSG_DAY_SHARE, array($this->sender->name, $day->title));
  }

  function onDayFavorite(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News([
      'day_id' => $day->id,
      'link' => "odom://day/{$day->id}"
    ]);

    if(1 == $day->getUser()->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($day->getUser());

    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($follower);

    $this->send($news, self::MSG_DAY_Favorite, array($this->sender->name, $day->title));
  }

  /**
   * @param Moment $moment
   */
  function onMoment(Moment $moment)
  {
    lmb_assert_true($moment->id);

    $news = new News(array('day_id' => $moment->day_id, 'moment_id' => $moment->id));

    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsNewDays())
        $this->addRecipient($follower);

    $this->send($news, self::MSG_MOMENT_CREATED, array($this->sender->getName(), $moment->getDay()->getTitle()));
  }

  function onMomentDelete(Moment $moment)
  {
    lmb_assert_true($moment->id);
    lmbActiveRecord :: delete('News', 'moment_id='.$moment->getId());
  }

  // TODO
  function onMomentRestore(Moment $moment) {}

  function onDayLike(Day $day, DayLike $like)
  {
    lmb_assert_true($day->id);
    $news = new News([
      'day_id' => $day->id,
      'day_like_id' => $like->id,
      'link' => "odom://day/{$day->id}"
    ]);
    $owner = $day->getUser();

    if($owner->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($owner);

    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($follower);

    $this->send($news, self::MSG_DAY_LIKED, array($this->sender->name, $day->title));
  }

  function onDayUnlike(Day $day, DayLike $like)
  {
    lmb_assert_true($like->id);
    News::delete('day_like_id='.$like->getId());
  }

  function onMomentLike(Moment $moment, MomentLike $like)
  {
    lmb_assert_true($moment->id);
    $news = new News([
      'day_id' => $moment->day_id,
      'moment_id' => $moment->id,
      'moment_like_id' => $like->id,
      'link' => "odom://moment/{$moment->id}"
    ]);
    $owner = $moment->getDay()->getUser();

    if($owner->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($owner);

    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($follower);

    $this->send($news, self::MSG_MOMENT_LIKED, array($this->sender->name, $moment->getDay()->title));
  }

  function onMomentUnlike(Moment $moment, MomentLike $like)
  {
    lmb_assert_true($like->id);
    News::delete('moment_like_id='.$like->getId());
  }

  function onDayComment(DayComment $comment)
  {
    lmb_assert_true($comment->id);
    $day = $comment->getDay();

    $news = new News;
    $news->day_comment_id = $comment->id;
    $news->day_id = $day->id;
    $news->link = "odom://day/{$day->id}/comment/{$comment->id}";

    if(1 == $day->getUser()->getSettings()->getNotificationsNewComments())
      $this->addRecipient($day->getUser());

    foreach ($day->getComments() as $day_comment)
    {
      $comment_author = $day_comment->getUser();
      if($this->sender->getId() != $comment_author->getId())
        if(1 == $comment_author->getSettings()->getNotificationsNewReplays())
          $this->addRecipient($comment_author);
    }

    $this->send($news, self::MSG_DAY_COMMENT, array($this->sender->name, $day->title));
  }

  function onDayCommentDelete(DayComment $comment)
  {
    lmb_assert_true($comment->id);
    News::delete('day_comment_id='.$comment->getId());
  }

  function onMomentComment(MomentComment $comment)
  {
    lmb_assert_true($comment->id);
    $moment = $comment->getMoment();
    $day    = $moment->getDay();

    $news = new News;
    $news->moment_id = $moment->id;
    $news->moment_comment_id = $comment->id;
    $news->day_id = $day->id;
    $news->link = "odom://moment/{$moment->id}/comment/{$comment->id}";

    if(1 == $day->getUser()->getSettings()->getNotificationsNewComments())
      $this->addRecipient($day->getUser());

    foreach ($moment->getComments() as $moment_comment)
    {
      $comment_author = $moment_comment->getUser();
      if($this->sender->getId() != $comment_author->getId())
        if(1 == $comment_author->getSettings()->getNotificationsNewReplays())
          $this->addRecipient($comment_author);
    }

    $this->send($news, self::MSG_MOMENT_COMMENT, array($this->sender->name, $day->title));
  }

  function onMomentCommentDelete(MomentComment $comment)
  {
    lmb_assert_true($comment->id);
    News::delete('moment_comment_id='.$comment->getId());
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
    $news->setText(self::getMessage($type, $params));
  }

  /**
   * Returns message based on it's $type and $params.
   *
   * @param  string $type      One of {@see odNewsService::MSG_*} constants. Notice: type is text-string right now.
   * @param  array  $params
   * @return string
   */
  public static function getMessage($type, array $params = array())
  {
    lmb_assert_type($type, 'string');
    array_unshift($params, $type);
    $replaces_mustbe = substr_count($type, '%');
    $replaces_given = count($params) - 1;
    if($replaces_mustbe != $replaces_given)
    {
      throw new lmbException("Wrong params count", array(
        'type' => $type,
        'params' => array_slice($params, 1)
      ));
    }
    return vsprintf($type, $params);
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
    lmb_assert_true($recipient->getId(), 'Recipient have no id');
    lmb_assert_true($this->sender->getId(), 'Sender have no id');
    if($recipient->getId() == $this->sender->getId())
      return;
    $this->recipients[$recipient->getId()] = $recipient;
  }

  protected function send(News $news, $type, array $params = array())
  {
    $text = self::getMessage($type, $params);
    $news->setSender($this->sender);
    $news->setText($text);
    $news->setRecipients($this->recipients);
    $news->save();

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
