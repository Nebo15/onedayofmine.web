<?php
lmb_require('src/model/*.class.php');

/**
 * News creator.
 */
class odNewsObserver
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
  const MSG_DAY_LIKED_DIRECT    = "%s liked your day %s";

  ## Moment ##
  const MSG_MOMENT_CREATED      = "%s created moment in day %s";
  const MSG_MOMENT_COMMENT      = "%s has responded you in moment of day %s";
  const MSG_MOMENT_LIKED        = "%s liked moment in day %s";
  const MSG_MOMENT_LIKED_DIRECT = "%s liked your moment in day %s";

  ## Follow ##
  const MSG_FOLLOW              = "%s started to follow %s";
  const MSG_FOLLOW_DIRECT       = "%s started to follow you";

  ## User ##
  const MSG_FBFRIEND_REGISTERED = "You'r facebook friend '%s' just started to use this application, follow hem?";

  /**
   * @var User
   */
  protected $sender;

  public function __construct(User $sender)
  {
    $this->sender = $sender;
  }

  /**
   * @param User $user
   */
  function onUserRegister(User $user)
  {
    $news = $this->createNews($user);
    $this->applyText($news, self::MSG_FBFRIEND_REGISTERED, array($user->getName()));

    $profile = lmbToolkit::instance()->getFacebookProfile($user);
    foreach ($profile->getRegisteredFriends() as $friend)
    {
      $this->sendToRecipient($news, $friend);
    }
  }

  /**
   * @param User $followed_user
   */
  function onFollow(User $followed_user)
  {
    $news = $this->createNews();

    // Send message "{user} started to follow you"
    $this->applyText($news, self::MSG_FOLLOW_DIRECT, array($this->sender->getName()));
    $this->sendToRecipient($news, $followed_user);

    // Send message "{user} started to follow {user}"
    $this->applyText($news, self::MSG_FOLLOW, array($this->sender->getName(), $followed_user->getName()));

    foreach($this->sender->getFollowers() as $recipient) {
      // Prevent sending 2 messages to same user
      if($recipient->getId() != $followed_user->getId())
        $this->sendToRecipient($news, $recipient);
    }
  }

  /**
   * @param Day $day
   */
  function onDay(Day $day)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_DAY_CREATED, array($this->sender->getName(), $day->getTitle()));
    $news->setDay($day);
    $this->sendToFollowers($news);
  }

  function onDayDelete(Day $day)
  {
    News::delete('day_id='.$day->getId());
  }

  /**
   * @param Moment $moment
   */
  function onMoment(Moment $moment)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_MOMENT_CREATED, array($this->sender->getName(), $moment->getDay()->getTitle()));
    $news->setDay($moment->getDay());
    $news->setMoment($moment);
    $this->sendToFollowers($news);
  }

  function onMomentDelete(Moment $moment)
  {
    lmbActiveRecord :: delete('News', 'moment_id='.$moment->getId());
  }

  /**
   * @todo moment like not implemented
   * @todo add {Day, Moment} interface
   * @param Day|Moment $liked_object
   */
  function onLike(lmbActiveRecord $liked_object)
  {
    $news = $this->createNews();
    if($liked_object instanceof Day) {
      $this->applyText($news, self::MSG_DAY_LIKED, array($this->sender->getName(), $liked_object->getTitle()));
    } elseif($liked_object instanceof Moment) {
      $this->applyText($news, self::MSG_MOMENT_LIKED, array($this->sender->getName(), $liked_object->getDay()->getTitle()));
    } else {
      throw new lmbException("Can't create news, unknown model passed. Day or Moment expected.");
    }
    $this->sendToFollowers($news);
  }

  /**
   * @param Commentable $comment
   */
  function onComment(BaseComment $comment)
  {
    $news = $this->createNews();
    $recipients = new lmbCollection();

    if($comment instanceof DayComment)
    {
      $day = $commented_object = $comment->getDay();
      $msg_type = self::MSG_DAY_COMMENT;
    }
    elseif($comment instanceof MomentComment)
    {
      $commented_object = $comment->getMoment();
      $day = $commented_object->getDay();
      $msg_type = self::MSG_MOMENT_COMMENT;
    }
    else
    {
      throw new lmbException("Can't create news, uknown model passed. DayComment or MomentComment expected.");
    }

    foreach ($commented_object->getComments() as $comment_author)
    {
      $comment_author = $comment_author->getUser();
      if($this->sender->getId() != $comment_author->getId())
        $recipients->add($comment_author);
    }

    $this->applyText($news, $msg_type, array($this->sender->getName(), $day->getTitle()));
    $this->sendToRecipients($news, $recipients);
  }

  /**
   * Apply message with text $text to news $news. You can specify additional text $params.
   *
   * @param  News  $news
   * @param  int   $type   One of {@see odNewsObserver::MSG_*} constants. Notice: type is text-string right now.
   * @param  array $params
   * @return void
   */
  public function applyText(News $news, $type, array $params = array())
  {
    lmb_assert_type($type, 'string');
    $news->setText(self::getMessage($type, $params));
//    $all_params = func_get_args();
//    $news->setText(self::getMessage($type, array_slice($all_params, 0)));
  }

  /**
   * Returns message based on it's $type and $params.
   *
   * @param  string $type      One of {@see odNewsObserver::MSG_*} constants. Notice: type is text-string right now.
   * @param  array  $params
   * @return string
   */
  public static function getMessage($type, array $params = array()) {
    lmb_assert_type($type, 'string');
    array_unshift($params, $type);
    return call_user_func_array('sprintf', $params);
  }

  /**
   * Send $news to all current user followers.
   *
   * @param News $news
   */
  protected function sendToFollowers(News $news) {
    $recipients = $this->sender->getFollowers();
    $this->sendToRecipients($news, $recipients);
  }

  /**
   * Send $news to all $recipients.
   *
   * @param  News                   $news
   * @param  lmbCollectionInterface $recipients
   */
  protected function sendToRecipients(News $news, lmbCollectionInterface $recipients) {
    foreach($recipients as $recipient) {
      $this->sendToRecipient($news, $recipient);
    }
  }

  /**
   * Send $news to specified $recipient.
   *
   * @param News $news
   * @param User $recipient
   */
  protected function sendToRecipient(News $news, User $recipient) {
    $news = clone $news;
    if($recipient->getId() == $this->sender->getId())
      throw new lmbException("User can't send message to hemself.");
    $news->setRecipient($recipient);
    $news->save();
  }

  ###########################################################
  ################ General-purpose functions ################
  ###########################################################
  /**
   * @return News
   */
  protected function createNews(User $user = null) {
    $news = new News();
    $news->setUser($user ?: $this->sender);
    return $news;
  }
}
