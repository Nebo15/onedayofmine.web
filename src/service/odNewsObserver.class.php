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
  const MSG_DAY_FAVOURITE       = "%s added the day %s to favorites";

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
    $this->send(new News(), self::MSG_FBFRIEND_REGISTERED, array($user->name));
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

    $news = new News(array('user_id' => $followed_user->id));
    $this->send($news, self::MSG_FOLLOW, array($this->sender->name, $followed_user->name));
  }

  /**
   * @param Day $day
   */
  function onDay(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News(array('day_id' => $day->id));
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

  function onDayShare(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News(array('day_id' => $day->id));
    if(1 == $day->getUser()->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($day->getUser());
    $this->send($news, self::MSG_DAY_SHARE, array($this->sender->name, $day->title));
  }

  function onDayFavourite(Day $day)
  {
    lmb_assert_true($day->id);
    $news = new News(array('day_id' => $day->id));

    if(1 == $day->getUser()->getSettings()->getNotificationsRelatedActivity())
      $this->addRecipient($day->getUser());

    foreach($this->sender->getFollowers() as $follower)
      if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($follower);

    $this->send($news, self::MSG_DAY_FAVOURITE, array($this->sender->name, $day->title));
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

  /**
   * @todo moment like not implemented
   * @todo add {Day, Moment} interface
   * @param Day|Moment $liked_object
   */
  function onLike(lmbActiveRecord $liked_object)
  {
    lmb_assert_true($liked_object->id);
    if(!($liked_object instanceof Day) && !($liked_object instanceof Moment))
      throw new lmbException("Not likeable object type '".get_class($liked_object)."'");

    if($liked_object instanceof Day)
    {
      $news = new News(array('day_id' => $liked_object->id));
      $owner = $liked_object->getUser();
      if($owner->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($owner);
      foreach($this->sender->getFollowers() as $follower)
        if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
          $this->addRecipient($follower);
      $this->send($news, self::MSG_DAY_LIKED, array($this->sender->name, $liked_object->title));
    }
    elseif($liked_object instanceof Moment)
    {
      $news = new News(array('day_id' => $liked_object->day_id, 'moment_id' => $liked_object->id));
      $owner = $liked_object->getDay()->getUser();
      if($owner->getSettings()->getNotificationsRelatedActivity())
        $this->addRecipient($owner);
      foreach($this->sender->getFollowers() as $follower)
        if(1 == $follower->getSettings()->getNotificationsRelatedActivity())
          $this->addRecipient($follower);
      $this->send($news, self::MSG_MOMENT_LIKED, array($this->sender->name, $liked_object->getDay()->title));
    }
  }

  /**
   * @param Commentable $comment
   */
  function onComment(BaseComment $comment)
  {
    lmb_assert_true($comment->id);
    $news = new News;

    if($comment instanceof DayComment)
    {
      $day = $comment->getDay();
      $commented_object = $comment->getDay();
      $msg_type = self::MSG_DAY_COMMENT;
      $news->day_comment_id = $comment->id;
    }
    elseif($comment instanceof MomentComment)
    {
      $commented_object = $comment->getMoment();
      $day = $commented_object->getDay();
      $msg_type = self::MSG_MOMENT_COMMENT;
      $news->moment_id = $commented_object->id;
      $news->moment_comment_id = $comment->id;
    }
    else
    {
      throw new lmbException("Unknown comment type ".get_class($comment));
    }

    $news->day_id = $day->id;

    if(1 == $day->getUser()->getSettings()->getNotificationsNewComments())
      $this->addRecipient($day->getUser());

    foreach ($commented_object->getComments() as $comment_author)
    {
      $comment_author = $comment_author->getUser();
      if($this->sender->getId() != $comment_author->getId())
        if(1 == $comment_author->getSettings()->getNotificationsNewReplays())
          $this->addRecipient($comment_author);
    }

    $this->send($news, $msg_type, array($this->sender->name, $day->title));
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
    $news->setSender($this->sender);

    $news->setText(self::getMessage($type, $params));
    $news->setRecipients($this->recipients);
    $news->save();
  }
}
