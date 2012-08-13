<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

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
    $info = lmbToolkit::instance()->getFacebookProfile($this->main_user)->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['uid'], $this->main_user->getFbUid());
  }

  function testGetInfo()
  {
    $info = lmbToolkit::instance()->getFacebookProfile($this->main_user)->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['fb_uid'], $this->main_user->getFbUid());
  }

  function testGetFriends()
  {
    $friends = lmbToolkit::instance()->getFacebookProfile($this->additional_user)->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['uid'], $this->main_user->getFbUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = lmbToolkit::instance()->getFacebookProfile($this->main_user)->getRegisteredFriends();
    $this->assertEqual(count($friends), 0);

    $this->additional_user->save();

    $friends = lmbToolkit::instance()->getFacebookProfile($this->main_user)->getRegisteredFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  function testGetPictures()
  {
    $pictures = lmbToolkit::instance()->getFacebookProfile($this->main_user)->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testGetPictures_PicturesIfDefault()
  {
    // foo should have default avatar
    $pictures = lmbToolkit::instance()->getFacebookProfile($this->additional_user)->getPictures();
    $this->assertEqual(count($pictures), 1);
  }

  function testGetPictureContents()
  {
    $profile = lmbToolkit::instance()->getFacebookProfile($this->main_user);
    $pictures = $profile->getPictures();
    $biggest = array_pop($pictures);
    $contents = $profile->getPictureContents($biggest);
    $this->assertTrue($contents);
  }

  function testBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testBeginDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day, $day_url);
    $this->assertTrue($fb_id);
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day, $day_url);
    lmbToolkit::instance()->getFacebookProfile($this->additional_user)->shareDayLike($day, $day_url);
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day, $day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $day_url, $moment, $moment_url);
    $this->assertTrue($fb_id);

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $day_url, $moment, $moment_url);
    $this->assertTrue($fb_id);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);
    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day, $day_url);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $day_url, $moment, $moment_url);
    $this->assertTrue($fb_id);

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentLike($moment, $moment_url);
  }

  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day, $day_url);
    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayEnd($day, $day_url);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDay($day, $day_url);
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
