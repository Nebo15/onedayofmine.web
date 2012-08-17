<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/odPostingService.class.php');

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
    $settings->setSocialShareFacebook(1);
    $settings->setSocialShareTwitter(1);
    $settings->save();

    $this->main_user->setFbAccessToken('Foo token');
    $this->main_user->setTwitterAccessToken('Foo token');
    $this->main_user->setTwitterAccessTokenSecret('Foo token');
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);
  }

  public function testShareDayBegin()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', true);
    $mock->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);
  }

  public function testShareDayBegin_0nlyFacebook()
  {
    $settings = $this->main_user->getSettings();
    $settings->setSocialShareFacebook(1);
    $settings->setSocialShareTwitter(0);
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', true);
    $mock->getFacebookProfile()->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);
  }

  public function testShareDayBegin_onlyTwitter()
  {
    $settings = $this->main_user->getSettings();
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(1);
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', true);
    $mock->getTwitterProfile()->expectOnce('shareDayBegin');

    $mock->shareDayBegin($day);
  }

  public function testShareDayBegin_dontShare()
  {
    $settings = $this->main_user->getSettings();
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(0);
    $settings->save();

    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayBegin', true);
    $mock->getFacebookProfile()->expectNever('shareDayBegin');
    $mock->getTwitterProfile()->expectNever('shareDayBegin');

    $mock->shareDayBegin($day);
  }

  function testShareDayLike()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayLike', true);
    $mock->expectOnce('shareDayLike');

    $mock->shareDayLike($day);
  }

  function testShareAddMoment()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareMomentAdd', true);
    $mock->expectOnce('shareMomentAdd');

    $mock->shareMomentAdd($day, $moment);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $moment = $this->generator->moment($day);

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareMomentLike', true);
    $mock->expectOnce('shareMomentLike');

    $mock->shareMomentLike($moment);
  }

  function testShareEndDay()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDayEnd', true);
    $mock->expectOnce('shareDayEnd');

    $mock->shareDayEnd($day);
  }

  function testShareDay()
  {
    $day = $this->generator->day();

    $mock = new odPostingServiceMock($this);
    $mock->setReturnValue('shareDay', true);
    $mock->expectOnce('shareDay');

    $mock->shareDay($day);
  }
}
