<?php

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
  const MSG_COMMENT_DAY            = "%s has responded you in %s";
  const MSG_COMMENT_MOMENT         = "{user} has responded you in {moment}";
  const MSG_FOLLOW                 = "%s started to follow %s";
  const MSG_FOLLOW_YOU             = "%s started to follow you";
  const MSG_FOLLOWED_DAY_CREATE    = "%s just created day %s";
  const MSG_FOLLOWED_MOMENT_CREATE = "%s created moment in day %s";
  const MSG_FOLLOWED_LIKE          = "{user} likes {day/moment}";
  const MSG_NEW_USER               = "You'r friend {user} just started to use this appliaction, follow hem?";

  public function notify($action, lmbActiveRecord $object) {
    $news = $this->createNews();
    $user = lmbToolkit :: instance()->getUser();
    $news->setUser($user);
    $username = $user->first_name . ' ' . $user->last_name;
    $recipients_blacklist_ids = array();

    switch ($action) {
      case self::ACTION_NEW_LIKE:
        if($object instanceof Day) {
          $news->setText($this->getMessage(self::MSG_LIKE_DAY,    $username, $object->getTitle()));
        } elseif($object instanceof Moment) {
          $news->setText($this->getMessage(self::MSG_LIKE_MOMENT, $username, $object->getDay()->getTitle())); // TODO moment like not implemented
        } else {
          throw new lmbException("Can't create news, uknown model passed. Day or Moment expected.");
        }
        break;

      case self::ACTION_NEW_COMMENT: // TODO not tested
        if($object instanceof DayComment) {
          $news->setText($this->getMessage(self::MSG_COMMENT_DAY,    $username, $object->getDay()->getTitle()));
        } elseif($object instanceof MomentComment) {
          $news->setText($this->getMessage(self::MSG_COMMENT_MOMENT, $username, $object->getMoment()->getDay()->getTitle()));
        } else {
          throw new lmbException("Can't create news, uknown model passed. DayComment or MomentComment expected.");
        }
        break;

      case self::ACTION_NEW_FOLLOW:
        if(!$object instanceof User)
          throw new lmbException("Can't create news, uknown model passed. User expected.");

        // Send message "{user} started to follow you"
        $direct_news = clone $news;
        $direct_news->setRecipient($object);
        $direct_news->setText($this->getMessage(self::MSG_FOLLOW_YOU, $username));
        $direct_news->save();

        // If followed user already in list of recipients, than add hem to blacklist to dont send duplicate message
        if(UserFollowing::isFollowing($object, $user))
          $recipients_blacklist_ids [] = $object->getId();

        // Message for followers, except added one
        $news->setText($this->getMessage(self::MSG_FOLLOW, $username, $object->getFirstName() . ' ' . $object->getLastName()));
        break;

      case self::ACTION_NEW_DAY:
        $news->setText($this->getMessage(self::MSG_FOLLOWED_DAY_CREATE, $username, $object->getTitle()));
        $news->setDay($object);
        break;

      case self::ACTION_NEW_MOMENT:
        $news->setText($this->getMessage(self::MSG_FOLLOWED_MOMENT_CREATE, $username, $object->getDay()->getTitle()));
        $news->setDay($object->getDay());
        $news->setMoment($object);
        break;

      case self::ACTION_NEW_USER: // TODO not implemented
        // Get FB users
        // Find registered in our app FB users
        // Send them notification
        break;

      default:
        throw new lmbException("Can't notify about unkown action '{$action}'.");
        break;
    }

    $this->sendAll($news, $user->getFollowers(), $recipients_blacklist_ids);
  }

  // TODO this should call lang file in future
  private function getMessage($type, $username, $object_title = '') {
    return sprintf($type, $username, $object_title);
  }

  private function createNews() {
    return new News();
  }

  private function sendAll($news, lmbCollectionInterface $recipients, array $recipients_blacklist_ids) {
    foreach($recipients as $recipient) {
      if(array_search($recipient->getId(), $recipients_blacklist_ids) === false) {
        $news = clone $news;
        $news->setRecipient($recipient);
        $news->save();
      }
    }
  }
}