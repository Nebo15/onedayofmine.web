<?php
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
  const MSG_LIKE_DAY               = "%s liked your day %s";
  const MSG_LIKE_MOMENT            = "{user} liked your moment in day {day_title}";
  const MSG_COMMENT_DAY            = "{user} has responded you in {day}";
  const MSG_COMMENT_MOMENT         = "{user} has responded you in {moment}";
  const MSG_FOLLOW                 = "%s started to follow %s";
  const MSG_FOLLOW_YOU             = "%s started to follow you";
  const MSG_FOLLOWED_DAY_CREATE    = "%s just created day %s";
  const MSG_FOLLOWED_MOMENT_CREATE = "%s created moment in day %s";
  const MSG_FOLLOWED_LIKE          = "{user} likes {day/moment}";
  const MSG_NEW_USER               = "You'r friend {user} just started to use this appliaction, follow hem?";

  /**
   * @var User
   */
  private $user;

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
        // TODO not tested
        $this->onLike($object);
        break;

      case self::ACTION_NEW_COMMENT:
        // TODO not tested
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
        // TODO not implemented
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
      $this->applyText($news, self::MSG_LIKE_DAY,    array($this->getUsername(), $object->getTitle()));
    } elseif($liked_object instanceof Moment) {
      $this->applyText($news, self::MSG_LIKE_MOMENT, array($this->getUsername(), $object->getDay()->getTitle()));
    } else {
      throw new lmbException("Can't create news, uknown model passed. Day or Moment expected.");
    }
    $this->sendToFollowers($news);
  }

  /**
   * @todo add "replied to you"
   * @todo add {DayComment, MomentComment} interface
   * @param DayComment|MomentComment $comment
   */
  protected function onComment(lmbActiveRecord $comment)
  {
    $news = $this->createNews();
    if($object instanceof DayComment) {
      $this->applyText($news, self::MSG_COMMENT_DAY,       array($this->getUsername(), $object->getDay()->getTitle()));
    } elseif($object instanceof MomentComment) {
      $this->applyText($news, self::MSG_COMMENT_MOMENT,    array($this->getUsername(), $object->getMoment()->getDay()->getTitle()));
    } else {
      throw new lmbException("Can't create news, uknown model passed. DayComment or MomentComment expected.");
    }
    $this->sendToFollowers($news);
  }

  /**
   * @param User $followed_user
   */
  protected function onFollow(User $followed_user)
  {
    $news = $this->createNews();

    // Send message "{user} started to follow you"
    $this->applyText($news, self::MSG_FOLLOW_YOU, array($this->getUsername()));
    $this->sendToRecipient($news, $followed_user);

    // Send message "{user} started to follow {user}"
    $this->applyText($news, self::MSG_FOLLOW,     array($this->getUsername(), $this->getUsername($followed_user)));

    foreach($this->user->getFollowers() as $recipient) {
      // Prevent sending 2 messages to same user
      if($recipient->getId() != $object->getId())
        $this->sendToRecipient($news, $recipient);
    }
  }

  /**
   * @param Day $day
   */
  protected function onDay(Day $day)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_FOLLOWED_DAY_CREATE, array($this->getUsername(), $object->getTitle()));
    $news->setDay($object);
    $this->sendToFollowers($news);
  }

  /**
   * @param Moment $moment
   */
  protected function onMoment(Moment $moment)
  {
    $news = $this->createNews();
    $this->applyText($news, self::MSG_FOLLOWED_MOMENT_CREATE, array($this->getUsername(), $object->getDay()->getTitle()));
    $news->setDay($object->getDay());
    $news->setMoment($object);
    $this->sendToFollowers($news);
  }

  /**
   * @param User $user
   */
  protected function onUser(User $user) {
    //$news = $this->createNews();
    //throw new Exception('Not implemented');
    // Get FB user friends
    // Find registered in our app FB users
    // Send them notification
    //$this->sendToFollowers($news);
  }

  ###########################################################
  ################## Internationalization ################### // TODO i18n on lang files
  ###########################################################
  /**
   * Apply message with text $text to news $news. You can specify additional text $params.
   *
   * @param  News  $news
   * @param  int   $type         One of {@see odNewsObserver::MSG_*} constants.
   * @param  array $object_title [description]
   * @return string
   */
  private function applyText(News $news, $type, array $params = array())
  {
    return call_user_func_array('sprintf', $obj_params);
  }

  /**
   * Returns username of $user. If no $user specified, then current logged-in user is used.
   *
   * @return string
   */
  private function getUsername(User $user = null) {
    if(is_null($user))
      $user = $this->user;

    return $user->first_name . ' ' . $user->last_name;
  }

  ###########################################################
  ################## News-sending functions #################
  ###########################################################
  /**
   * Send $news to all current user followers.
   *
   * @param News $news
   */
  private function sendToFollowers(News $news) {
    $recipients = $this->user->getFollowers();
    $this->sendToRecipients($news, $recipients);
  }

  /**
   * Send $news to all $recipients.
   *
   * @param  News                   $news
   * @param  lmbCollectionInterface $recipients
   */
  private function sendToRecipients(News $news, lmbCollectionInterface $recipients) {
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
  private function sendToRecipient(News $news, User $recipient) {
    $news = clone $news;
    $news->setRecipient($recipient);
    $news->save();
  }

  ###########################################################
  ################ General-purpose functions ################
  ###########################################################
  /**
   * @return News
   */
  private function createNews() {
    $news = new News();
    $news->setUser($this->user);
    return $news;
  }
}
