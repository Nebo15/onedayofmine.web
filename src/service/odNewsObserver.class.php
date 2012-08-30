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
  const MSG_DAY_SHARE           = "%s share day %s";

  ## Moment ##
  const MSG_MOMENT_CREATED      = "%s created moment in day %s";
  const MSG_MOMENT_COMMENT      = "%s has responded you in moment of day %s";
  const MSG_MOMENT_LIKED        = "%s liked moment in day %s";

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

  function odDayShare(Day $day)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_DAY_SHARE, array($this->sender->getName(), $day->getTitle()));
    $news->setDay($day);
    $this->sendToFollowers($news);
    $this->sendToRecipient($news, $day->getUser());
  }

  /**
   * @param Moment $moment
   */
  function onMoment(Moment $moment)
  {
    if(!$moment->id)
      throw new lmbException('Not saved moment');

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
    if(!($liked_object instanceof Day) && !($liked_object instanceof Moment))
      throw new lmbException("Not likeable object type '".get_class($liked_object)."'");

    $news = $this->createNews();
    if($liked_object instanceof Day)
    {
      $owner = $liked_object->getUser();
      $this->applyText($news, self::MSG_DAY_LIKED, array($this->sender->getName(), $liked_object->getTitle()));
    }
    elseif($liked_object instanceof Moment)
    {
      $owner = $liked_object->getDay()->getUser();
      $this->applyText($news, self::MSG_MOMENT_LIKED, array($this->sender->getName(), $liked_object->getDay()->getTitle()));
    }
    $this->sendToFollowers($news);
    if($owner->id != $this->sender->id)
      $this->sendToRecipient($news, $owner);
  }

  /**
   * @param Commentable $comment
   */
  function onComment(BaseComment $comment)
  {
    $news = $this->createNews();
    $recipients = array();

    if($comment instanceof DayComment)
    {
      $day = $comment->getDay();
      $commented_object = $comment->getDay();
      $msg_type = self::MSG_DAY_COMMENT;
    }
    else
    {
      $commented_object = $comment->getMoment();
      $day = $commented_object->getDay();
      $msg_type = self::MSG_MOMENT_COMMENT;
    }

    $recipients[$day->user_id] = $day->getUser();
    foreach ($commented_object->getComments() as $comment_author)
    {
      $comment_author = $comment_author->getUser();
      if($this->sender->getId() != $comment_author->getId())
        $recipients[$comment_author->id] = $comment_author;
    }

    $this->applyText($news, $msg_type, array($this->sender->name, $day->title));
    $this->sendToRecipients($news, new lmbCollection($recipients));
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
