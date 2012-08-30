<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odNewsObserver.class.php');

Mock::generate('FacebookProfile', 'FacebookProfileMock');

class NewsObserverAcceptanceTest extends odUnitTestCase
{
  /**
   * @var odNewsObserver
   */
  protected $main_user_observer;

  function setUp()
  {
    parent::setUp();

    $this->main_user->save();

    $this->additional_user->getFollowing()->add($this->main_user);
    $this->additional_user->save();

    $this->main_user_observer = new odNewsObserver($this->main_user);
  }

  function testOnDay()
  {
    $day = $this->generator->day($this->main_user);

    $this->main_user_observer->onDay($day);

    $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           odNewsObserver::MSG_DAY_CREATED,
                           array($this->main_user->name, $day->title,));
  }

  function testOnDayDelete()
  {
    $day = $this->generator->day($this->main_user);
    $this->main_user_observer->onDay($day);
    $this->main_user_observer->onDayDelete($day);

    $news = News::findNewsForUser($this->additional_user);
    $this->assertEqual($news->count(), 0);
  }

  function testOnComment_DayComment()
  {
    $old_commentor = $this->generator->user();
    $new_commentor = $this->main_user;

    $day = $this->generator->day($new_commentor);
    $old_comment = $this->generator->dayComment($day, $old_commentor);
    $old_comment->save();

    $comment = $this->generator->dayComment($day, $new_commentor);

    $this->main_user_observer->onComment($comment);

    $this->assertEqual(News::find()->count(), 1);

    $this->assertEqual($this->additional_user->getNews()->count(), 0);

    if($this->assertEqual($old_commentor->getNews()->count(), 1))
    {
      $one_news = $old_commentor->getNews()->at(0);
      $this->assertEqual($one_news->getUser()->getId(), $new_commentor->getId());
      $this->assertEqual($one_news->text, odNewsObserver::getMessage(odNewsObserver::MSG_DAY_COMMENT, array(
        $new_commentor->name,
        $day->getTitle(),
      )));
    }
  }

  function testOnMoment()
  {
    $moment = $this->generator->moment();
    $this->main_user_observer->onMoment($moment);

    $this->_checkMessage($this->additional_user,
      $this->main_user,
      odNewsObserver::MSG_MOMENT_CREATED,
      array(
        $this->main_user->getName(),
        $moment->getDay()->getTitle(),
      ));
  }


  function testOnMomentDelete()
  {
    $moment = $this->generator->moment();
    $this->main_user_observer->onMoment($moment);

    $this->main_user_observer->onMomentDelete($moment);

    $this->assertEqual(News::find()->count(), 0);
  }

  function testOnComment_MomentComment()
  {
    $old_commentor = $this->generator->user();
    $new_commentor = $this->main_user;

    $day = $this->generator->day($new_commentor);
    $moment = $this->generator->moment($day);
    $old_comment = $this->generator->momentComment($moment, $old_commentor);
    $old_comment->save();

    $comment = $this->generator->momentComment($moment, $new_commentor);

    $this->main_user_observer->onComment($comment);

    $this->assertEqual(News::find()->count(), 1);

    $this->assertEqual($this->additional_user->getNews()->count(), 0);

    if($this->assertEqual($old_commentor->getNews()->count(), 1))
    {
      $one_news = $old_commentor->getNews()->at(0);
      $this->assertEqual($one_news->getUser()->getId(), $new_commentor->getId());
      $this->assertEqual($one_news->text, odNewsObserver::getMessage(odNewsObserver::MSG_MOMENT_COMMENT, array(
        $new_commentor->name,
        $day->getTitle(),
      )));
    }
  }


  // TODO
  function testOnCommentDelete() {}

  function testFollow()
  {
    $foo = $this->generator->user();
    $foo->save();
    $bar = $this->generator->user();
    $bar->save();
    $dum = $this->generator->user();
    $dum->save();

    (new odNewsObserver($bar))->onFollow($foo);
    $this->_checkFollowMessage($foo, $bar, $foo, odNewsObserver::MSG_FOLLOW_DIRECT);

    $foo->addToFollowers($dum);
    (new odNewsObserver($foo))->onFollow($bar);
    $this->_checkFollowMessage($foo, $bar, $foo, odNewsObserver::MSG_FOLLOW_DIRECT);
    $this->_checkFollowMessage($foo, $bar, $dum, odNewsObserver::MSG_FOLLOW_DIRECT);
  }

  // TODO
  function testOnUnfollow() {}

  function testRegister()
  {
    $new_user = $this->generator->user('new');
    $new_user->save();

    $friend = $this->generator->user('friend');
    $friend->save();

    $mock = new FacebookProfileMock();
    $mock->setReturnValue('getRegisteredFriends', array($friend));
    $this->toolkit->setFacebookProfile($new_user, $mock);

    (new odNewsObserver($new_user))->onUser($new_user);

    $this->_checkMessage($friend,
                         $new_user,
                         odNewsObserver::MSG_FBFRIEND_REGISTERED,
                         array($new_user->name));
  }

  function testOnLike()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->main_user_observer->onLike($day);
    $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           odNewsObserver::MSG_DAY_LIKED,
                           array(
                            $this->main_user->getName(),
                            $day->getTitle(),
                           ));
  }

  // TODO
  function testOnLikeDelete() {}

  protected function _checkMessage($recipient, $creator, $message, $params, $news_count = 1, $news = null)
  {
    // Get news
    $news = $news ?: $recipient->getNews();
    // Enshure we created news
    if($this->assertEqual($news->count(), $news_count)) {
      // Enshure that sender ID was set correctly
      $this->assertEqual($news->at(0)->getUser()->getId(), $creator->getId());
      // Check message
      $this->assertEqual($news->at(0)->text, odNewsObserver::getMessage($message, $params));
    }
  }

  protected function _checkFollowMessage($recipient, $follower, $followed, $message, $news_count = 1)
  {
    $params = array($follower->name, $followed->name);
    $this->_checkMessage($recipient, $follower, $message, $params, $news_count);
  }

  protected function _getUsername($user) {
    return $user->name;
  }
}
