<?php
lmb_require('src/model/*.class.php');

/**
 * News creator.
 */
class odNewsObserver {
  /*
   * Actions for odNewsObserver notify.
   */
  const ACTION_NEW_LIKE    = 0;
  const ACTION_NEW_COMMENT = 1;
  const ACTION_NEW_FOLLOW  = 2;
  const ACTION_NEW_DAY     = 3;
  const ACTION_NEW_MOMENT  = 4;
  const ACTION_NEW_USER    = 5;
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
  const MSG_FBFRIEND_REGISTERED = "You'r facebook friend '%s' just started to use this appliaction as '%s', follow hem?";

  /**
   * @var User
   */
  protected $user;

  public function __construct()
  {
    $this->user = lmbToolkit :: instance()->getUser();
  }

  /**
   * Create news for all current user friends that describe $action on some $object.
   *
   * @param  int             $action One of {@see odNewsObserver::ACTION_*} constants.
   * @param  lmbActiveRecord $object Model
   * @return void
   * @throws lmbException
   */
  public function notify($action, lmbActiveRecord $object)
  {
    switch ($action) {
      case self::ACTION_NEW_LIKE:
        $this->onLike($object);
        break;

      case self::ACTION_NEW_COMMENT:
        $this->onComment($object);
        break;

      case self::ACTION_NEW_FOLLOW:
        $this->onFollow($object);
        break;

      case self::ACTION_NEW_DAY:
        $this->onDay($object);
        break;

      case self::ACTION_NEW_MOMENT:
        $this->onMoment($object);
        break;

      case self::ACTION_NEW_USER:
        $this->onUser($object);
        break;

      default:
        throw new lmbException("Can't notify about unkown action '{$action}'.");
        break;
    }
  }

  ###########################################################
  ################# Actions implementations #################
  ###########################################################
  /**
   * @todo moment like not implemented
   * @todo add {Day, Moment} interface
   * @param Day|Moment $liked_object
   */
  protected function onLike(lmbActiveRecord $liked_object)
  {
    $news = $this->createNews();
    if($liked_object instanceof Day) {
      $this->applyText($news, self::MSG_DAY_LIKED, array($this->getUsername(), $liked_object->getTitle()));
    } elseif($liked_object instanceof Moment) {
      $this->applyText($news, self::MSG_MOMENT_LIKED, array($this->getUsername(), $liked_object->getDay()->getTitle()));
    } else {
      throw new lmbException("Can't create news, uknown model passed. Day or Moment expected.");
    }
    $this->sendToFollowers($news);
  }

  /**
   * @param Comment $comment
   */
  protected function onComment(Comment $comment)
  {
    $news = $this->createNews();
    $recipients = new lmbCollection();
    // We dont spam news with comments
    // foreach ($this->user->getFollowers() as $follower) {
    //   $recipients->add($follower);
    // }

    if($comment instanceof DayComment) {
      $day = $commented_object = $comment->getDay();
      $msg_type = self::MSG_DAY_COMMENT;
    } elseif($comment instanceof MomentComment) {
      $commented_object = $comment->getMoment();
      $day = $commented_object->getDay();
      $msg_type = self::MSG_MOMENT_COMMENT;
    } else {
      throw new lmbException("Can't create news, uknown model passed. DayComment or MomentComment expected.");
    }

    foreach ($commented_object->getComments() as $comment_author) {
      $comment_author = $comment_author->getUser();
      if($this->user->getId() != $comment_author->getId())
        $recipients->add($comment_author);
    }

    $this->applyText($news, $msg_type, array($this->getUsername(), $day->getTitle()));
    $this->sendToRecipients($news, $recipients);
  }

  /**
   * @param User $followed_user
   */
  protected function onFollow(User $followed_user)
  {
    $news = $this->createNews();

    // Send message "{user} started to follow you"
    $this->applyText($news, self::MSG_FOLLOW_DIRECT, array($this->getUsername()));
    $this->sendToRecipient($news, $followed_user);

    // Send message "{user} started to follow {user}"
    $this->applyText($news, self::MSG_FOLLOW,     array($this->getUsername(), $this->getUsername($followed_user)));

    foreach($this->user->getFollowers() as $recipient) {
      // Prevent sending 2 messages to same user
      if($recipient->getId() != $followed_user->getId())
        $this->sendToRecipient($news, $recipient);
    }
  }

  /**
   * @param Day $day
   */
  protected function onDay(Day $day)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_DAY_CREATED, array($this->getUsername(), $day->getTitle()));
    $news->setDay($day);
    $this->sendToFollowers($news);
  }

  /**
   * @param Moment $moment
   */
  protected function onMoment(Moment $moment)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_MOMENT_CREATED, array($this->getUsername(), $moment->getDay()->getTitle()));
    $news->setDay($moment->getDay());
    $news->setMoment($moment);
    $this->sendToFollowers($news);
  }

  /**
   * @param User $user
   */
  protected function onUser(User $user) {
    $news = $this->createNews($user);
    $this->applyText($news, self::MSG_FBFRIEND_REGISTERED, array(
                                                            $this->getUsername((object) FacebookUser::getUserInfo($user->getFbAccessToken())),
                                                            $this->getUsername($user)
                                                           ));
    foreach ($user->getFacebookUser()->getUserFriendsInApplication() as $friend) {
      $this->sendToRecipient($news, $friend);
    }
  }

  ###########################################################
  ################## Internationalization ################### // TODO i18n on lang files
  ###########################################################
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
    $news->setText(self::getMessage($type, $params));
  }

  /**
   * Returns message based on it's $type and $params.
   *
   * @param  int $type      One of {@see odNewsObserver::MSG_*} constants. Notice: type is text-string right now.
   * @param  array  $params
   * @return string
   */
  public static function getMessage($type, array $params = array()) {
    array_unshift($params, $type);
    return call_user_func_array('sprintf', $params);
  }

  /**
   * Returns username of $user. If no $user specified, then current logged-in user is used.
   *
   * @param User|stdClass $user
   * @return string
   */
  public function getUsername($user = null) {
    if(is_null($user))
      $user = $this->user;

    return $user->name;
  }

  ###########################################################
  ################## News-sending functions #################
  ###########################################################
  /**
   * Send $news to all current user followers.
   *
   * @param News $news
   */
  protected function sendToFollowers(News $news) {
    $recipients = $this->user->getFollowers();
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
    if($recipient->getId() == $this->user->getId())
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
    $news->setUser($user ?: $this->user);
    return $news;
  }
}
