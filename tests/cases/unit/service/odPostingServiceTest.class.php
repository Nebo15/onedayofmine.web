<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odPostingService.class.php');
lmb_require('src/model/Day.class.php');

Mock::generate('FacebookProfile');
Mock::generate('TwitterProfile');

class odPostingServiceMock extends odPostingService
{
  public function __construct($unit_test)
  {
    $this->facebook_profile = new MockFacebookProfile($unit_test);
    $this->twitter_profile  = new MockTwitterProfile($unit_test);
  }

  public function getFacebookProfile()
  {
    return $this->facebook_profile;
  }

  public function getTwitterProfile()
  {
    return $this->twitter_profile;
  }

  public function setReturnValue($method, $value)
  {
    $this->getFacebookProfile()->setReturnValue($method, $value);
    $this->getTwitterProfile()->setReturnValue($method, $value);
  }

  public function expectOnce($method)
  {
    $this->getFacebookProfile()->expectOnce($method);
    $this->getTwitterProfile()->expectOnce($method);
  }
}

class odPostingServiceTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();

    $settings = $this->main_user->getSettings();
    $settings->social_share_facebook = 1;
    $settings->social_share_twitter = 1;
    $settings->save();

    $this->main_user->facebook_access_token = 'Foo token';
    $this->main_user->twitter_access_token = 'Foo token';
    $this->main_user->twitter_access_token_secret = 'Foo token';
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);
  }

  public function testShareDayBegin()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', 'dummy_social_id');
    $mock->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);
  }

  public function testShareDayBegin_onlyFacebook()
  {
    $settings = $this->main_user->getSettings();
    $settings->social_share_facebook = 1;
    $settings->social_share_twitter = 0;
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', 'dummy_social_id');
    $mock->getFacebookProfile()->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);

    $this->assertEqual($day->facebook_id, 'dummy_social_id');
    $this->assertFalse($day->twitter_id);
  }

  public function testShareDayBegin_onlyTwitter()
  {
    $settings = $this->main_user->getSettings();
    $settings->social_share_facebook = 0;
    $settings->social_share_twitter = 1;
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', 'dummy_social_id');
    $mock->getTwitterProfile()->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);

    $this->assertFalse($day->facebook_id);
    $this->assertEqual($day->twitter_id, 'dummy_social_id');
  }

  public function testShareDayBegin_dontShare()
  {
    $settings = $this->main_user->getSettings();
    $settings->social_share_facebook = 0;
    $settings->social_share_twitter = 0;
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', 'dummy_social_id');
    $mock->getFacebookProfile()->expectNever('shareDayBegin');
    $mock->getTwitterProfile()->expectNever('shareDayBegin');

    $mock->shareDayBegin($day);

    $this->assertFalse($day->facebook_id);
    $this->assertFalse($day->twitter_id);
  }

  function testShareDayLike()
  {
    $day = $this->generator->day();
    $like = $this->generator->dayLike($day);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayLike', 'dummy_social_id');
    $mock->expectOnce('shareDayLike');

    $mock->shareDayLike($day, $like);

    $this->assertEqual($like->facebook_id, 'dummy_social_id');
    $this->assertEqual($like->twitter_id, 'dummy_social_id');
  }

  function testShareDayUnlike()
  {
    $day = $this->generator->day();
    $like = $this->generator->dayLike($day);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayUnlike', 'dummy_social_id');
    $mock->expectOnce('shareDayUnlike');

    $mock->shareDayUnlike($day, $like);
  }

  function testShareAddMoment()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareMomentAdd', 'dummy_social_id');
    $mock->expectOnce('shareMomentAdd');

    $mock->shareMomentAdd($day, $moment);

    $this->assertEqual($moment->facebook_id, 'dummy_social_id');
    $this->assertEqual($moment->twitter_id, 'dummy_social_id');
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $like = $this->generator->momentLike($moment);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareMomentLike', 'dummy_social_id');
    $mock->expectOnce('shareMomentLike');

    $mock->shareMomentLike($moment, $like);

    $this->assertEqual($like->facebook_id, 'dummy_social_id');
    $this->assertEqual($like->twitter_id, 'dummy_social_id');
  }

  function testShareMomentUnlike()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);
    $like = $this->generator->momentLike($moment);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareMomentUnlike', 'dummy_social_id');
    $mock->expectOnce('shareMomentUnlike');

    $mock->shareMomentUnlike($moment, $like);
  }

  function testShareEndDay()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayEnd', 'dummy_social_id');
    $mock->expectOnce('shareDayEnd');

    $mock->shareDayEnd($day);
  }

  function testShareDay()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDay', 'dummy_social_id');
    $mock->expectOnce('shareDay');

    $mock->shareDay($day);
  }
}
