<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');
lmb_require('src/odNewsObserver.class.php');


class NewsObserverAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News', 'Day', 'DayComment', 'Moment', 'MomentComment', 'User', 'UserFollowing');
    // Users should have fixed ids in each test
    $this->main_user->save();
    // Bar follow Foo
    $this->additional_user->getFollowing()->add($this->main_user);
    $this->additional_user->save();
    // Login since we use pure API calls
    $this->_loginAndSetCookie($this->main_user);
  }

  function testCreateDay()
  {
    $params = $this->generator->day($this->main_user)->exportForApi();
    $day = $this->post('current_day/start', $params)->result;

    if($this->assertResponse(200)) {
      $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           $this->additional_user,
                           odNewsObserver::MSG_DAY_CREATED,
                           array(
                            $this->_getUsername($this->main_user),
                            $params->title,
                           ),
                           $news_count = 1);
    }
  }

  function testDeleteDay()
  {
    // Create and enshure it was created
    $this->testCreateDay();
    $this->assertEqual($this->additional_user->getNews()->count(), 1);

    // Delete
    $this->post('days/'.$this->additional_user->getNews()->at(0)->day_id.'/delete')->result;

    if($this->assertResponse(200)) {
      $news = News::findNewForUser($this->additional_user);
      $this->assertEqual($news->count(), 0);
    }
  }

  function testCreateDayComment()
  {
    $user = $this->generator->user();
    $user->save();

    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->generator->dayComment($day, $user)->save();

    $response = $this->post('days/'.$day->getId().'/comment_create', array(
      'text' => $text = $this->generator->string(255)
    ));

    if($this->assertResponse(200))
    {
      // Followers dont spammed by comment messages
      $this->assertEqual($this->additional_user->getNews()->count(), 0);
      // But users, that took place in conversation are notified
      $this->_checkMessage($user,
                           $this->main_user,
                           $user,
                           odNewsObserver::MSG_DAY_COMMENT,
                           array(
                            $this->_getUsername($this->main_user),
                            $day->getTitle(),
                           ),
                           $news_count = 1);
    }
  }

  // NOTICE: not needed
  function testDeleteDayComment(){}

  function testCreateMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $res = $this->post('current_day/moment_create', array(
        'description' => $description = $this->generator->string(200),
        'image_name' => $image_path = 'foo/bar/example.png',
        'image_content' => 'iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc/YPAAAAAElFTkSuQmCC'
    ))->result;

    if($this->assertResponse(200))
    {
      $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           $this->additional_user,
                           odNewsObserver::MSG_MOMENT_CREATED,
                           array(
                            $this->_getUsername($this->main_user),
                            $day->getTitle(),
                           ),
                           $news_count = 1);
    }
  }

  function testDeleteMoment()
  {
    // Create and enshure it was created
    $this->testCreateMoment();
    $this->assertEqual($this->additional_user->getNews()->count(), 1);

    // Delete
    $this->post('moments/'.$this->additional_user->getNews()->at(0)->moment_id.'/delete');
    if($this->assertResponse(200)) {
      $this->assertEqual($this->additional_user->getNews()->count(), 0);
    }
  }

  function testCreateMomentComment()
  {
    $user = $this->generator->user();
    $user->save();

    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->generator->momentComment($moment, $user)->save();

    $res = $this->post('moments/'.$moment->getId().'/comment', array(
      'text' => $text = $this->generator->string(255)
    ))->result;

    if($this->assertResponse(200))
    {
      // Followers dont spammed by comment messages
      $this->assertEqual($this->additional_user->getNews()->count(), 0);
      // But users, that took place in conversation are notified
      $this->_checkMessage($user,
                           $this->main_user,
                           $user,
                           odNewsObserver::MSG_MOMENT_COMMENT,
                           array(
                            $this->_getUsername($this->main_user),
                            $day->getTitle(),
                           ),
                           $news_count = 1);
    }
  }

  // NOTICE: not needed
  function testDeleteMomentComment(){}

  function testFollow()
  {
    // Remove default following
    $this->additional_user->getFollowing()->remove($this->main_user);
    $this->additional_user->save();

    // We need 3 users: Dum
    $user = $this->generator->user();
    $user->save();

    // Login as Bar
    $this->_loginAndSetCookie($this->additional_user);

    // 1. Bar follows Foo
    $this->post('users/'.$this->main_user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Foo recieve: Bar follows you
      $this->_checkFollowMessage($this->main_user, $this->additional_user, $this->main_user, odNewsObserver::MSG_FOLLOW_DIRECT);
    }
    // Login as Foo
    $this->_loginAndSetCookie($this->main_user);

    // 2. Foo follows Dum
    $this->post('users/'.$user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Bar recieve: Foo follows Dum
      $this->_checkFollowMessage($this->additional_user, $this->main_user, $user, odNewsObserver::MSG_FOLLOW);

      // Dum recieve: Foo follows you
      $this->_checkFollowMessage($user, $this->main_user, $user, odNewsObserver::MSG_FOLLOW_DIRECT);
    }

    // Foo follows Bar
    $this->post('users/'.$this->additional_user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Bar recieve 2nd message: Foo follows you
      $this->_checkFollowMessage($this->additional_user, $this->main_user, $this->additional_user, odNewsObserver::MSG_FOLLOW_DIRECT, 2);

      // Dum dont recieve any news messages since he dont follow anyone
      $this->assertEqual($user->getNews()->count(), 1);
    }
  }

  // TODO
  function testRegister()
  {

  }

  function testLikeDay()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->post('days/'.$day->getId().'/like');
    if($this->assertResponse(200))
    {
      $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           $this->additional_user,
                           odNewsObserver::MSG_DAY_LIKED,
                           array(
                            $this->_getUsername($this->main_user),
                            $day->getTitle(),
                           ),
                           $news_count = 1);
    }
  }

  // TODO not implemented
  function estLikeMoment()
  {
    // ...
    if($this->assertResponse(200))
    {
      $this->_checkMessage($this->additional_user,
                           $this->main_user,
                           $this->additional_user,
                           odNewsObserver::MSG_MOMENT_LIKED,
                           array(
                            $this->_getUsername($this->main_user),
                            $day->getTitle(),
                           ),
                           $news_count = 1);
    }
  }

  protected function _checkMessage($recipient, $follower, $followed, $message, $params, $news_count = 1)
  {
    // Get news
    $news = $recipient->getNews();
    // Enshure we created news
    $this->assertEqual($news->count(), $news_count);
    // Enshure that sender ID was set correctly
    $this->assertEqual($news->at(0)->getUser()->getId(), $follower->getId());
    // Check message
    $this->assertEqual($news->at(0)->text, odNewsObserver::getMessage($message, $params));
  }

  protected function _checkFollowMessage($recipient, $follower, $followed, $message, $news_count = 1)
  {
    // Check following in DB
    $this->assertTrue(UserFollowing::isFollowing($follower, $followed));
    // Check message
    $params = array($this->_getUsername($follower), $this->_getUsername($followed));
    $this->_checkMessage($recipient, $follower, $followed, $message, $params, $news_count);
  }

  protected function _getUsername(User $user) {
    return "{$user->first_name} {$user->last_name}";
  }
}
