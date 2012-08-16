<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class TwitterProfileTest extends odUnitTestCase
{

  public function setUp()
  {
    parent::setUp();

    $this->main_user->setTwitterUid($this->generator->twitter_credentials()[0]['uid']);
    $this->main_user->setTwitterAccessToken($this->generator->twitter_credentials()[0]['access_token']);
    $this->main_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[0]['access_token_secret']);
    $this->main_user->getSettings()->setSocialShareTwitter(1);
    $this->main_user->save();

    $this->additional_user->setTwitterUid($this->generator->twitter_credentials()[1]['uid']);
    $this->additional_user->setTwitterAccessToken($this->generator->twitter_credentials()[1]['access_token']);
    $this->additional_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[1]['access_token_secret']);
    $this->additional_user->getSettings()->setSocialShareTwitter(1);
    $this->additional_user->save();
  }

  function testGetInfoRaw()
  {
    $info = lmbToolkit::instance()->getTwitterProfile($this->main_user)->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['id'], $this->main_user->getTwitterUid());
  }

  function testGetInfo()
  {
    $info = lmbToolkit::instance()->getTwitterProfile($this->main_user)->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['twitter_uid'], $this->main_user->getTwitterUid());
  }

  function testGetFriendsIds()
  {
    $ids = lmbToolkit::instance()->getTwitterProfile($this->additional_user)->getFriendsIds();
    $this->assertEqual(count($ids), 1);
    $this->assertEqual($ids[0], $this->main_user->getTwitterUid());
  }

  function testGetFriends()
  {
    $friends = lmbToolkit::instance()->getTwitterProfile($this->additional_user)->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['id'], $this->main_user->getTwitterUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = lmbToolkit::instance()->getTwitterProfile($this->main_user)->getRegisteredFriends();
    if($this->assertEqual(count($friends), 1))
      $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  function testGetPictures()
  {
    $pictures = lmbToolkit::instance()->getTwitterProfile($this->main_user)->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testGetPictures_PicturesIfDefault()
  {
    // bar should have default avatar
    $pictures = lmbToolkit::instance()->getTwitterProfile($this->additional_user)->getPictures();
    $this->assertEqual(count($pictures), 0);
  }

  function testGetPictureContents()
  {
    $profile = lmbToolkit::instance()->getTwitterProfile($this->main_user);
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

    $provider = lmbToolkit::instance()->getTwitterProfile($this->main_user);
    $tweet = $provider->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $tweet = lmbToolkit::instance()->getTwitterProfile($this->additional_user)->shareDayLike($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDayBegin($day);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $moment = $this->generator->moment($day);
    $moment->save();
    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDayBegin($day);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareMomentLike($moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet);
    }
  }

  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();

    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDayEnd($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();


    $tweet = lmbToolkit::instance()->getTwitterProfile($this->main_user)->shareDay($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
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
