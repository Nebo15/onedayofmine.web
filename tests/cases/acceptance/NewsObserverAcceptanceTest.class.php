<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class NewsObserverAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News', 'Day', 'DayComment', 'Moment', 'MomentComment', 'User', 'UserFollowing');
    // Users should have fixed ids in each test
    $this->additional_user->save();
    // Bar follow Foo
    $this->additional_user->getFollowing()->add($this->main_user);
    $this->main_user->save();
    // Login since we use pure API calls
    $this->_loginAndSetCookie($this->main_user);
  }

  function testCreateDay()
  {
    $params = $this->generator->day($this->main_user)->exportForApi();
    $day = $this->post('current_day/start', $params)->result;

    if($this->assertResponse(200)) {
      $news = $this->additional_user->getNews();
      $this->assertEqual($news->count(), 1);
      $this->assertEqual($this->main_user->getId(), $news->at(0)->getUser()->getId());
      $this->assertEqual($day->id, $news->at(0)->day_id);
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
      $news = News::findNewForUser($this->additional_user);
      $this->assertEqual($news->count(), 1);
      $this->assertEqual($res->day_id, $news->at(0)->day_id);
      $this->assertEqual($day->getMoments()->at(0)->getId(), $news->at(0)->moment_id);
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

  // TODO
  function testCreateDayComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $response = $this->post('days/'.$day->getId().'/comment_create', array(
      'text' => $text = $this->generator->string(255)
    ));

    if($this->assertResponse(200))
    {
      $this->assertEqual($day->getComments()->at(0)->getId(), $response->result->id);
      $this->assertEqual($day->getId(), $response->result->day_id);
      $this->assertEqual($text, $response->result->text);
    }
  }

  // TODO
  function testCreateMomentComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $res = $this->post('moments/'.$moment->getId().'/comment', array(
      'text' => $text = $this->generator->string(255)
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual($moment->getComments()->at(0)->getId(), $res->id);
    $this->assertEqual($moment->getId(), $res->moment_id);
    $this->assertEqual($text, $res->text);
  }

  // TODO
  function testRespondYouInComments() {

  }

  function testFollow() {
    // We need 3 users: Dum
    $user = $this->generator->user();
    $user->save();

    // Remove default follow
    $following = $this->additional_user->getFollowing();
    $following->remove($this->main_user);
    $following->save();

    // Login as Bar
    $this->_loginAndSetCookie($this->additional_user);

    // 1. Bar follows Foo
    $this->post('users/'.$this->main_user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Foo recieve: Bar follows you
      $this->_checkFollowingMessage($this->main_user, $this->additional_user, $this->main_user, odNewsObserver::MSG_FOLLOW_YOU);
    }
    // Login as Foo
    $this->_loginAndSetCookie($this->main_user);

    // 2. Foo follows Dum
    $this->post('users/'.$user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Bar recieve: Foo follows Dum
      $this->_checkFollowingMessage($this->additional_user, $this->main_user, $user, odNewsObserver::MSG_FOLLOW);

      // Dum recieve: Foo follows you
      $this->_checkFollowingMessage($user, $this->main_user, $user, odNewsObserver::MSG_FOLLOW_YOU);
    }

    // Foo follows Bar
    $this->post('users/'.$this->additional_user->getId().'/follow');
    if($this->assertResponse(200)) {
      // Bar recieve 2nd message: Foo follows you
      $this->_checkFollowingMessage($this->additional_user, $this->main_user, $this->additional_user, odNewsObserver::MSG_FOLLOW_YOU, 2);

      // Dum dont recieve any news messages since he dont follow anyone
      $this->assertEqual($user->getNews()->count(), 1);
    }
  }

  function _checkFollowingMessage($recipient, $follower, $followed, $message, $news_count = 1) {
    // Check following in DB
    $this->assertTrue(UserFollowing::isFollowing($follower, $followed));
    // Check news
    $news = $recipient->getNews();
    // Enshure we created news
    $this->assertEqual($news->count(), $news_count);
    // Enshure that sender ID was set correctly
    $this->assertEqual($news->at(0)->getUser()->getId(), $follower->getId());
    // Check message
    $this->assertEqual($news->at(0)->text, sprintf($message, "{$follower->first_name} {$follower->last_name}", "{$followed->first_name} {$followed->last_name}"));
  }

  // TODO something
  function testRegister() {

  }

  // TODO
  function testLikeDay() {

  }
}
