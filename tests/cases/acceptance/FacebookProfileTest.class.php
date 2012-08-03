<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class FacebookProfileTest extends odUnitTestCase
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

  function testGetInfoRaw()
  {
    $info = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['uid'], $this->main_user->getFbUid());
  }

  function testGetInfo()
  {
    $info = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['fb_uid'], $this->main_user->getFbUid());
  }

  function testGetFriends()
  {
    $friends = $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['uid'], $this->main_user->getFbUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getRegisteredFriends();
    $this->assertEqual(count($friends), 0);

    $this->additional_user->save();

    $friends = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getRegisteredFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  function testGetPictures()
  {
    $pictures = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testBeginDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayBegin($day_url);
    $this->assertTrue($fb_id);
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayBegin($day_url);
    $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayLike($day_url);
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayBegin($day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayBegin($day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);

    $fb_id = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareMomentAdd($moment_url, $day_url);
    $this->assertTrue($fb_id);

    $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareMomentLike($moment_url);
  }

  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayBegin($day_url);
    $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDayEnd($day_url);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDay($day, $day_url);
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
