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

  /**
   * @var UserForSettingsTests
   */
  protected $sender;
  /**
   * @var UserForSettingsTests
   */
  protected $follower;

  function setUp()
  {
    parent::setUp();
    $this->sender = new UserForSettingsTests($this->generator->user('sender'));
    $this->sender->save();
    $this->sender_observer = new odNewsObserver($this->sender);
    $this->follower = new UserForSettingsTests($this->generator->user());
    $this->follower->save();
    $this->sender->addToFollowers($this->follower);
    $this->sender->save();
  }

  function testOnDay()
  {
    $day = $this->generator->day($this->sender, false, 'testOnDay');
    $day->save();

    $this->sender_observer->onDay($day);

    $news = $this->follower->getNews()->at(0);
    $this->assertNewsUsers($news, $this->follower, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_CREATED, $this->sender->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnDay_DisabledInSettings()
  {
    $this->follower->disableNotification('new_days');
    $this->follower->save();

    $day = $this->generator->day($this->sender, false, 'testOnDay');
    $day->save();

    $this->sender_observer->onDay($day);

    $this->assertNoNews($this->follower);
  }

  function testOnDayDelete()
  {
    $day = $this->generator->day($this->sender, false, 'testOnDay');
    $day->save();
    $day_to_delete = $this->generator->day($this->sender);
    $day_to_delete->save();
    $this->sender_observer->onDay($day);
    $this->sender_observer->onDay($day_to_delete);
    $this->sender_observer->onDayDelete($day_to_delete);

    $this->assertEqual(1, $this->follower->getNews()->count());
  }

  function testOnComment_DayComment_Owner()
  {
    $day_owner = $this->generator->user('onwer');
    $day_owner->save();
    $commentator = $this->generator->user('cmmentator');
    $commentator->save();

    $day = $this->generator->day($day_owner, false, 'some_day');

    $comment = $this->generator->dayComment($day, $commentator);
    $comment->save();

    (new odNewsObserver($commentator))->onComment($comment);

    $news = $day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $day_owner, $commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_COMMENT, $commentator->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
    $this->assertEqual($comment->id, $news->day_comment_id);
  }

  function testOnComment_DayComment_Owner_DisabledInSettings()
  {
    $day_owner = $this->_createUserWithDisabledNotification('new_comments');
    $day_owner->save();

    $commentator = $this->generator->user('commentator');
    $commentator->save();

    $day = $this->generator->day($day_owner, false, 'some_day');
    $comment = $this->generator->dayComment($day, $commentator);
    $comment->save();

    (new odNewsObserver($commentator))->onComment($comment);

    $this->assertNoNews($day_owner);
  }

  function testOnComment_DayComment_OldCommentator()
  {
    $old_commentator = $this->generator->user('old_commentator');
    $old_commentator->save();
    $new_commentator = $this->generator->user('new_commentator');
    $new_commentator->save();

    $day = $this->generator->day();
    $day->save();
    $old_comment = $this->generator->dayComment($day, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->dayComment($day, $new_commentator);
    $comment->save();

    (new odNewsObserver($new_commentator))->onComment($comment);

    $news = $old_commentator->getNews()->at(0);
    $this->assertNewsUsers($news, $old_commentator, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_COMMENT, $new_commentator->name, $day->title);
  }

  function testOnComment_DayComment_OldCommentator_DisabledInSettings()
  {
    $old_commentator = $this->_createUserWithDisabledNotification('new_replays');
    $old_commentator->save();
    $new_commentator = $this->generator->user();
    $new_commentator->save();

    $day = $this->generator->day();
    $day->save();
    $old_comment = $this->generator->dayComment($day, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->dayComment($day, $new_commentator);
    $comment->save();

    (new odNewsObserver($new_commentator))->onComment($comment);

    $this->assertNoNews($old_commentator);
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
    $this->assertEqual($day->id, $news->day_id);
    $this->assertEqual($moment->id, $news->moment_id);
  }

  function testOnMoment_DisabledInSettings()
  {
    $this->follower->disableNotification('new_days');
    $this->follower->save();

    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $moment->save();
    $this->sender_observer->onMoment($moment);

    $this->assertNoNews($this->follower);
  }

  function testOnMomentDelete()
  {
    $moment = $this->generator->moment();
    $moment->save();
    $this->sender_observer->onMoment($moment);
    $this->sender_observer->onMomentDelete($moment);

    $this->assertNoNews($this->follower);
  }

  function testOnComment_MomentComment_DayOwner()
  {
    $commentator = $this->sender;
    $commentator->save();

    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $comment = $this->generator->momentComment($moment, $commentator);
    $comment->save();

    (new odNewsObserver($commentator))->onComment($comment);

    $news = $day->getUser()->getNews()->at(0);
    $this->assertNewsUsers($news, $day->getUser(), $commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_MOMENT_COMMENT, $commentator->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
    $this->assertEqual($moment->id, $news->moment_id);
    $this->assertEqual($comment->id, $news->moment_comment_id);
  }

  function testOnComment_MomentComment_DayOwner_DisabledInSettings()
  {
    $commentator = $this->sender;
    $commentator->save();

    $day_owner = $this->_createUserWithDisabledNotification('new_comments');
    $day_owner->save();

    $day = $this->generator->day($day_owner);
    $moment = $this->generator->moment($day);
    $comment = $this->generator->momentComment($moment, $commentator);
    $comment->save();

    (new odNewsObserver($commentator))->onComment($comment);

    $this->assertNoNews($day->getUser());
  }

  function testOnComment_MomentComment_OldCommentator()
  {
    $old_commentator = $this->generator->user();
    $new_commentator = $this->sender;

    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $old_comment = $this->generator->momentComment($moment, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->momentComment($moment, $new_commentator);
    $comment->save();

    (new odNewsObserver($new_commentator))->onComment($comment);

    $news = $old_commentator->getNews()->at(0);
    $this->assertNewsUsers($news, $old_commentator, $new_commentator);
    $this->assertNewsText($news, odNewsObserver::MSG_MOMENT_COMMENT, $new_commentator->name, $day->title);
  }

  function testOnComment_MomentComment_OldCommentator_DisabledInSettings()
  {
    $old_commentator = $this->_createUserWithDisabledNotification('new_replays');
    $old_commentator->save();
    $new_commentator = $this->sender;

    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $old_comment = $this->generator->momentComment($moment, $old_commentator);
    $old_comment->save();

    $comment = $this->generator->momentComment($moment, $new_commentator);
    $comment->save();

    (new odNewsObserver($new_commentator))->onComment($comment);

    $this->assertNoNews($old_commentator);
  }

  function testFollow_Followed()
  {
    $foo = $this->generator->user('foo');
    $foo->save();
    $bar = $this->generator->user('bar');
    $bar->save();

    (new odNewsObserver($bar))->onFollow($foo);

    $this->assertEqual(1, count($foo->getNews()));
    $news = $foo->getNews()->at(0);
    $this->assertNewsUsers($news, $foo, $bar);
    $this->assertNewsText($news, odNewsObserver::MSG_FOLLOW, $bar->name, $foo->name);
    $this->assertEqual($foo->id, $news->user_id);
  }

  function testFollow_Followers()
  {
    $foo = $this->generator->user('foo');
    $foo->save();
    $bar = $this->generator->user('bar');
    $bar->save();
    $dum = $this->generator->user('dum');
    $dum->save();

    $foo->addToFollowers($dum);

    (new odNewsObserver($foo))->onFollow($bar);

    $this->assertEqual(1, count($dum->getNews()));
    $news = $dum->getNews()->at(0);
    $this->assertNewsUsers($news, $dum, $foo);
    $this->assertNewsText($news, odNewsObserver::MSG_FOLLOW, $foo->name, $bar->name);
  }

  function testFollow_Followers_DisableInSettings()
  {
    $foo = $this->generator->user('foo');
    $foo->save();
    $bar = $this->generator->user('bar');
    $bar->save();
    $dum = $this->_createUserWithDisabledNotification('related_activity', 'dum');
    $dum->save();

    $foo->addToFollowers($dum);

    (new odNewsObserver($foo))->onFollow($bar);

    $this->assertNoNews($dum);
  }

  function testUserRegister()
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

  function testOnLike_DayOwner()
  {
    $day_owner = $this->generator->user();
    $day = $this->generator->day($day_owner);
    $day->save();

    $this->sender_observer->onLike($day);

    $news = $day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $day_owner, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_LIKED, $this->sender->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnLike_DayOwner_DisabledInSettings()
  {
    $day_owner = $this->_createUserWithDisabledNotification('related_activity');
    $day = $this->generator->day($day_owner);
    $day->save();

    $this->sender_observer->onLike($day);

    $this->assertNoNews($day_owner);
  }

  function testOnLike_Followers()
  {
    $day_owner = $this->generator->user();
    $day = $this->generator->day($day_owner);
    $day->save();

    $this->sender_observer->onLike($day);

    $news = $this->follower->getNews()->at(0);
    $this->assertNewsUsers($news, $this->follower, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_LIKED, $this->sender->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnLike_Followers_DisabledInSettings()
  {
    $this->follower->disableNotification('related_activity');
    $this->follower->save();

    $day = $this->generator->day();
    $day->save();

    $this->sender_observer->onLike($day);

    $this->assertNoNews($this->follower);
  }

  function testOnDayShare()
  {
    $user_who_share = $this->generator->user();
    $user_who_share->save();
    $user_day_owner = $this->generator->user();
    $user_day_owner->save();
    $day = $this->generator->day($user_day_owner);
    $day->save();

    (new odNewsObserver($user_who_share))->onDayShare($day);

    $this->assertEqual(1, count($user_day_owner->getNews()));
    $news = $user_day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $user_day_owner, $user_who_share);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_SHARE, $user_who_share->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnDayShare_DisabledInSettings()
  {
    $user_who_share = $this->generator->user();
    $user_who_share->save();
    $day_owner = $this->_createUserWithDisabledNotification('related_activity');
    $day_owner->save();
    $day = $this->generator->day($day_owner);
    $day->save();

    (new odNewsObserver($user_who_share))->onDayShare($day);

    $this->assertNoNews($day_owner);
  }

  function testOnDayFavourite_UserContent()
  {
    $user_who_favourite = $this->generator->user();
    $user_who_favourite->save();
    $user_day_owner = $this->generator->user();
    $user_day_owner->save();
    $day = $this->generator->day($user_day_owner);
    $day->save();

    (new odNewsObserver($user_who_favourite))->onDayFavourite($day);

    $this->assertEqual(1, count($user_day_owner->getNews()));
    $news = $user_day_owner->getNews()->at(0);
    $this->assertNewsUsers($news, $user_day_owner, $user_who_favourite);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_FAVOURITE, $user_who_favourite->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnDayFavourite_UserContent_DisabledInSettings()
  {
    $user_who_favourite = $this->generator->user();
    $user_who_favourite->save();
    $day_owner = $this->_createUserWithDisabledNotification('related_activity');
    $day_owner->save();
    $day = $this->generator->day($day_owner);
    $day->save();

    (new odNewsObserver($user_who_favourite))->onDayFavourite($day);

    $this->assertNoNews($day_owner);
  }

  function testOnDayFavourite_Followers()
  {
    $day = $this->generator->day();
    $day->save();

    $this->sender_observer->onDayFavourite($day);

    $this->assertEqual(1, count($this->follower->getNews()));
    $news = $this->follower->getNews()->at(0);
    $this->assertNewsUsers($news, $this->follower, $this->sender);
    $this->assertNewsText($news, odNewsObserver::MSG_DAY_FAVOURITE, $this->sender->name, $day->title);
    $this->assertEqual($day->id, $news->day_id);
  }

  function testOnDayFavourite_Followers_DisabledInSettings()
  {
    $this->follower->disableNotification('related_activity');
    $this->follower->save();

    $day = $this->generator->day();
    $day->save();

    $this->sender_observer->onDayFavourite($day);

    $this->assertNoNews($this->follower);
  }

  protected function assertNoNews(User $user)
  {
    if(count($user->getNews()))
      return $this->fail('User have news');
    return $this->pass();
  }

  protected function assertNewsUsers(News $news, $valid_recipient, $sender)
  {
    if($news->sender_id != $sender->id)
      return $this->fail('Wrong sender');
    foreach($news->getRecipients() as $recipient)
      if($recipient->id == $valid_recipient->id)
        return $this->pass();
    return $this->fail('Wrong recipient');
  }

  protected function assertNewsText(News $news, $message, $params)
  {
    $params = array_slice(func_get_args(), 2);
    $text = odNewsObserver::getMessage($message, $params);
    return $this->assertEqual($text, $news->text);
  }

  protected function _createUserWithDisabledNotification($notification_name, $user_name = null)
  {
    $user = $this->generator->user($user_name);
    $settings = $user->getSettings();
    $settings->set('notifications_'.$notification_name, 0);
    $user->setSettings($settings);
    return $user;
  }
}

class UserForSettingsTests extends User
{
  protected $_db_table_name = 'user';

  function disableNotification($notification_name)
  {
    $settings = $this->getSettings();
    $settings->set('notifications_'.$notification_name, 0);
    $this->setSettings($settings);
  }
}
