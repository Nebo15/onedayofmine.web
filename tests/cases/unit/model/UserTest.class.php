<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/model/User.class.php');

class UserTest extends odUnitTestCase
{
	function testValidator_UniqueFacebookUid()
	{
		$user1 = $this->generator->user()->save();
		$user2 = $this->generator->unsavedUser();
		$user2->facebook_uid = $user1->facebook_uid;
		$errors_list = new lmbErrorList();
		$user2->trySave($errors_list);
		$this->assertEqual(1, count($errors_list));
		$this->assertPattern('/facebook_uid/', $errors_list[0]->getReadable());
		$this->assertPattern('/already exists/', $errors_list[0]->getReadable());
	}

	function testValidator_UniqueFacebookAccessToken()
	{
		$user1 = $this->generator->user()->save();
		$user2 = $this->generator->unsavedUser();
		$user2->facebook_access_token = $user1->facebook_access_token;
		$errors_list = new lmbErrorList();
		$user2->trySave($errors_list);
		$this->assertEqual(1, count($errors_list));
		$this->assertPattern('/facebook_access_token/', $errors_list[0]->getReadable());
		$this->assertPattern('/already exists/', $errors_list[0]->getReadable());
	}

  function testFindWithOldDays()
  {
    $time_current = time();
    $time_day_ago = $time_current - 24 * 60 * 60 - 1;

    $user_with_old_day = $this->generator->user();
    $user_with_old_day->save();
    $old_day = $this->generator->day($user_with_old_day);
    $old_day->ctime = $time_day_ago;
    $old_day->save();
    $user_with_old_day->setCurrentDay($old_day);
    $user_with_old_day->save();

    $user_with_new_day = $this->generator->user();
    $user_with_new_day->save();
    $new_day = $this->generator->day($user_with_new_day);
    $new_day->ctime = $time_current;
    $new_day->save();
    $user_with_new_day->setCurrentDay($new_day);
    $user_with_new_day->save();

    $users = User::findWithOldDays();
    if($this->assertEqual(1, count($users)))
      $this->assertEqual($user_with_old_day->id, $users[0]->id);
  }

  function testGetNews()
  {
    // With is used because im testing relation in both sides
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    // User to News
    $this->assertEqual(count($recipient->getNewsWithLimitation()), 1);
    $this->assertEqual(count($recipient->getNewsWithLimitation()), 1);
    $this->assertEqual($recipient->getNewsWithLimitation()->at(0)->id, $news->id);

    // News to User
    $this->assertEqual($news->getRecipients()->at(0)->id, $recipient->id);
  }

	function testMarkNewsAsRead()
	{
		// With is used because im testing relation in both sides
		$recipient = $this->generator->user();
		$another_recipient = $this->generator->user();

		$first_news = $this->generator->news(null, [$recipient, $another_recipient]);
		$second_news = $this->generator->news(null, [$recipient, $another_recipient]);

		// User to News
		$this->assertEqual(count($recipient->getNewsWithLimitation()), 2);
		$this->assertEqual(count($recipient->getUnreadNewsWithLimitation()), 2);
		$this->assertEqual(count($another_recipient->getNewsWithLimitation()), 2);
		$this->assertEqual(count($another_recipient->getUnreadNewsWithLimitation()), 2);

		$recipient->markNewsAsRead([$first_news]);
		$this->assertEqual(count($recipient->getNewsWithLimitation()), 2);
		$this->assertEqual(count($recipient->getUnreadNewsWithLimitation()), 1);
		$this->assertEqual(count($another_recipient->getNewsWithLimitation()), 2);
		$this->assertEqual(count($another_recipient->getUnreadNewsWithLimitation()), 2);
	}

	function testGetDaysBeginTime()
	{
		$day = $this->generator->day($this->main_user);
		$moment = $this->generator->moment($day);
		$moment->time = time();
		$moment->save();

		$another_user_day = $this->generator->day($this->additional_user);
		$this->generator->moment($another_user_day);

		$times = $this->main_user->getDaysBeginTime();
		$this->assertEqual(1, count($times));
		$this->assertEqual($day->id, $times[0]['day_id']);
		$this->assertEqual($moment->id, $times[0]['moment_id']);
		$this->assertEqual($moment->time, $times[0]['time']);
	}

	function testFindUsersWithUnreadNews()
	{
		$valid_notification_period = UserSettings::NOTIFICATIONS_PERIOD_DAILY;

		$user = $this->_createUserWithNotificationPeriod($valid_notification_period);
		$this->generator->news(null, $user);
		$this->generator->news(null, $user);

		$user_wrong_period = $valid_user = $this->_createUserWithNotificationPeriod(UserSettings::NOTIFICATIONS_PERIOD_TWICE_DAY);
		$this->generator->news(null, $user_wrong_period);
		$this->generator->news(null, $user_wrong_period);

		$user_without_news = $this->_createUserWithNotificationPeriod($valid_notification_period);

		$user_without_unread_news = $this->_createUserWithNotificationPeriod($valid_notification_period);
		$news1 = $this->generator->news(null, $user_without_unread_news);
		$news2 = $this->generator->news(null, $user_without_unread_news);
		$user_without_unread_news->markNewsAsRead([$news1, $news2]);

		$this->assertEqual(1, count(User::findWithUnreadNews($valid_notification_period)));
	}

	protected function _createUserWithNotificationPeriod($period)
	{
		$user = $this->generator->user();
		$settings = $user->getSettings();
		$settings->notifications_period_fb = $period;
		$settings->save();
		return $user;
	}
}
