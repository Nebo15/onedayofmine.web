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
    $this->assertEqual(count($pictures), 0);
  }

  function testGetPictureContents()
  {
    $profile = lmbToolkit::instance()->getFacebookProfile($this->main_user);
    $pictures = $profile->getPictures();
    $biggest = array_pop($pictures);
    $contents = $profile->getPictureContents($biggest);
    $this->assertTrue($contents);
  }

  function testShareBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareBeginDay');
    $day->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day);
    $this->assertTrue($fb_id);
  }

  function testShareLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareLikeDay');
    $day->save();

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day);
    lmbToolkit::instance()->getFacebookProfile($this->additional_user)->shareDayLike($day);
  }

  function testShareAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareAddMoment - Day');
    $day->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $moment);
    $this->assertTrue($fb_id);

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $moment);
    $this->assertTrue($fb_id);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day);
    $day->setFbId($fb_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $fb_id = lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentAdd($day, $moment);
    $this->assertTrue($fb_id);

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareMomentLike($moment);
  }

  function testShareEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareEndDay - Day');
    $day->save();

    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayBegin($day);
    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDayEnd($day);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();


    lmbToolkit::instance()->getFacebookProfile($this->main_user)->shareDay($day);
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
