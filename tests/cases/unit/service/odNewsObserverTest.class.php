<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odNewsObserver.class.php');

Mock::generate('FacebookProfile', 'FacebookProfileMock');

class odNewsObserverTest extends odUnitTestCase
{
  /**
   * @var odNewsObserver
   */
  protected $sender_observer;

  protected $sender;
  protected $follower;

  function setUp()
  {
    parent::setUp();
    $this->sender = $this->generator->user('sender');
    $this->sender->save();
    $this->sender_observer = new odNewsObserver($this->sender);
    $this->follower = $this->generator->user();
    $this->follower->save();
    $this->sender->addToFollowers($this->follower);
    $this->sender->save();
  }

  function testOnDay()
  {
    $day = $this->generator->day($this->sender, false, 'testOnDay');

    $this->sender_observer->onDay($day);

    $this->assertNewsUsers(News::findOne(), $this->follower, $this->sender);
    $this->assertNewsText(News::findOne(), odNewsObserver::MSG_DAY_CREATED, $this->sender->name, $day->title);
  }

  function testOnDayDelete()
  {
    $day = $this->generator->day($this->sender);
    $this->sender_observer->onDay($day);
    $this->sender_observer->onDayDelete($day);

    $news = News::findNewsForUser($this->follower);
    $this->assertEqual($news->count(), 0);
  }

  function testOnComment_DayComment_OldCommentator()
  {
    $day_owner = $this->generator->user('onwer');
    $old_commentator = $this->generator->user('old_commentator');
    $new_commentator = $this->generator->user('new_commentator');

    $day = $this->generator->day($day_owner, false, 'some_day');
    $old_comment = $this->generator->dayComment($day, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->dayComment($day, $new_commentator);

    (new odNewsObserver($new_commentator))->onComment($comment);

    $this->assertEqual(News::find()->count(), 2);

    $news = $day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $day_owner, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_COMMENT, $new_commentator->name, $day->title);

    $news = $old_commentator->getNews()->at(0);
    $this->assertNewsUsers($news, $old_commentator, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_COMMENT, $new_commentator->name, $day->title);
  }

  function testOnMoment()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $moment->save();
    $this->sender_observer->onMoment($moment);

    $news = News::findOne();
    $this->assertNewsUsers($news, $this->follower,$this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_MOMENT_CREATED, $this->sender->name, $day->title);
  }

  function testOnMomentDelete()
  {
    $moment = $this->generator->moment();
    $moment->save();
    $this->sender_observer->onMoment($moment);
    $this->sender_observer->onMomentDelete($moment);

    $this->assertEqual(News::find()->count(), 0);
  }

  function testOnComment_MomentComment()
  {
    $day_owner = $this->generator->user('onwer');
    $old_commentator = $this->generator->user();
    $new_commentator = $this->sender;

    $day = $this->generator->day($day_owner);
    $moment = $this->generator->moment($day);
    $old_comment = $this->generator->momentComment($moment, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->momentComment($moment, $new_commentator);

    (new odNewsObserver($new_commentator))->onComment($comment);

    $this->assertEqual(News::find()->count(), 2);

    $news = $day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $day_owner, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_MOMENT_COMMENT, $new_commentator->name, $day->title);

    $news = $old_commentator->getNews()->at(0);
    $this->assertNewsUsers($news, $old_commentator, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_MOMENT_COMMENT, $new_commentator->name, $day->title);
  }

  function testFollow()
  {
    $foo = $this->generator->user('foo');
    $foo->save();
    $bar = $this->generator->user('bar');
    $bar->save();
    $dum = $this->generator->user('dum');
    $dum->save();


    (new odNewsObserver($bar))->onFollow($foo);

    $news = $foo->getNews()->at(0);
    $this->assertNewsUsers($news, $foo, $bar);
    $this->assertNewsText($news, odNewsObserver::MSG_FOLLOW_DIRECT, $bar->name);


    $foo->addToFollowers($dum);
    (new odNewsObserver($foo))->onFollow($bar);

    $news = $bar->getNews()->at(0);
    $this->assertNewsUsers($news, $bar, $foo);
    $this->assertNewsText($news, odNewsObserver::MSG_FOLLOW_DIRECT, $foo->name);

    $news = $dum->getNews()->at(0);
    $this->assertNewsUsers($news, $dum, $foo);
    $this->assertNewsText($news, odNewsObserver::MSG_FOLLOW, $foo->name, $bar->name);
  }

  function testRegister()
  {
    $new_user = $this->generator->user('new');
    $new_user->save();

    $friend = $this->generator->user('friend');
    $friend->save();

    $mock = new FacebookProfileMock();
    $mock->setReturnValue('getRegisteredFriends', array($friend));
    $this->toolkit->setFacebookProfile($new_user, $mock);

    (new odNewsObserver($new_user))->onUserRegister($new_user);

    $news = $friend->getNews()->at(0);
    $this->assertNewsUsers($news, $friend, $new_user);
    $this->assertNewsText($news, odNewsObserver::MSG_FBFRIEND_REGISTERED, $new_user->name);
  }

  function testOnLike()
  {
    $day_owner = $this->generator->user();
    $day = $this->generator->day($day_owner);
    $day->save();

    $this->sender_observer->onLike($day);

    $this->assertEqual(2, News::find()->count());

    $news = $this->follower->getNews()->at(0);
    $this->assertNewsUsers($news, $this->follower, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_LIKED, $this->sender->name, $day->title);

    $news = $day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $day_owner, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_LIKED, $this->sender->name, $day->title);
  }

//  function testOnDayShare()
//  {
//    $sender = $this->generator->user();
//    $day = $this->generator->day();
//    $day->save();
//  }

  protected function assertNewsUsers(News $news, $recipient, $sender)
  {
    if(!$news->user_id = $sender->id)
      return $this->fail('Wrong sender');
    if(!$news->recipient_id = $recipient->id)
      return $this->fail('Wrong recipient');
  }

  protected function assertNewsText(News $news, $message, $params)
  {
    $params = array_slice(func_get_args(), 2);
    $text = odNewsObserver::getMessage($message, $params);
    return $this->assertEqual($text, $news->text);
  }
}
