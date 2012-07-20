<?php
/*
+Новые дни тех, кого зафоловил
+Лайки для контента пользователя (лайк дней и моментов)
+Комментарии для контента пользователя
+Комментарии к контенту, который прокомментировал пользователь
Новые фоловеры пользователя
Ваш друг начал использовать приложение, follow him
Новые люди, которых зафоловили те, кого читает пользователь
Лайки людей, которых читает пользователь
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
  const MSG_LIKE_DAY               = "{user} liked your day {day_title}";
  const MSG_LIKE_MOMENT            = "{user} liked your moment {moment_title} in day {day_title}";
  const MSG_COMMENT_DAY            = "{user} has responded you in {day}";
  const MSG_COMMENT_MOMENT         = "{user} has responded you in {moment}";
  const MSG_FOLLOW                 = "{user} started to follow you";
  const MSG_FOLLOWED_DAY_CREATE    = "{user} just created day {day_title}";
  const MSG_FOLLOWED_MOMENT_CREATE = "{user} created moment";
  const MSG_FOLLOWED_LIKE          = "{user} likes {day/moment}";
  const MSG_FOLLOWED_FOLLOW        = "{user} started to follow {user2}";
  const MSG_NEW_USER               = "You'r friend {user} just started to use this appliaction, follow hem?";

  public function notify($action, BaseModel $object) {
    $news = $this->_createNews();
    switch ($action) {
      case self::ACTION_NEW_LIKE:
        # code...
        break;
      case self::ACTION_NEW_COMMENT:
        # code...
        break;
      case self::ACTION_NEW_FOLLOW:
        # code...
        break;
      case self::ACTION_NEW_DAY:
        # code...
        break;
      case self::ACTION_NEW_MOMENT:
        # code...
        break;
      case self::ACTION_NEW_USER:
        // Get FB users
        // Find registered in our app FB users
        // Send them notification
        break;
      default:
        throw new lmbException("Can't notify about unkown action '{$action}'.");
        break;
    }
  }

  private function sendAll(lmbCollection $recepients) {
    foreach($resepients as $resepient) {
      $news->setRecepient($resepient);
      $news->save();
    }
  }

  private function _createNews() {
    $news = new News();
  }
}