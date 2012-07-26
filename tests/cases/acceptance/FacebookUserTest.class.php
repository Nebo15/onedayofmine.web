<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class FacebookUserTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();
    $settings = $this->main_user->getSettings();
    $settings->setSocialShareFacebook(1);
    $settings->save();

    $settings = $this->additional_user->getSettings();
    $settings->setSocialShareFacebook(1);
    $settings->save();
  }

  function testBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testBeginDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $fb_id = $this->main_user->getFacebookUser()->shareDayBegin($day_url);
    $this->assertTrue($fb_id);
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getFacebookUser()->shareDayBegin($day_url);
    $this->additional_user->getFacebookUser()->shareDayLike($day_url);
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = $this->main_user->getFacebookUser()->shareDayBegin($day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = $this->main_user->getFacebookUser()->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = $this->main_user->getFacebookUser()->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = $this->main_user->getFacebookUser()->shareDayBegin($day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);

    $fb_id = $this->main_user->getFacebookUser()->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);

    $this->main_user->getFacebookUser()->shareMomentLike($moment_url);
  }


  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getFacebookUser()->shareDayBegin($day_url);
    $this->main_user->getFacebookUser()->shareDayEnd($day_url);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getFacebookUser()->shareDay($day, $day_url);
  }

  protected function _copyDayPageToProxy(Day $day)
  {
    return lmbToolkit::instance()->copyDayPageToProxy($day);
  }

  protected function _copyMomentPageToProxy(Moment $moment)
  {
    return lmbToolkit::instance()->copyMomentPageToProxy($moment);
  }
}
