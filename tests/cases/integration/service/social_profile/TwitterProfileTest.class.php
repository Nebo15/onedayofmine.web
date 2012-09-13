<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class TwitterProfileTest extends odAcceptanceTestCase
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
    $info = (new TwitterProfile($this->main_user))->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['id'], $this->main_user->getTwitterUid());
  }

  function testGetInfo()
  {
    $info = (new TwitterProfile($this->main_user))->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['twitter_uid'], $this->main_user->getTwitterUid());
  }

  function testGetFriendsIds()
  {
    $ids = (new TwitterProfile($this->additional_user))->getFriendsIds();
    $this->assertEqual(count($ids), 1);
    $this->assertEqual($ids[0], $this->main_user->getTwitterUid());
  }

  function testGetFriends()
  {
    $friends = (new TwitterProfile($this->additional_user))->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['id'], $this->main_user->getTwitterUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = (new TwitterProfile($this->main_user))->getRegisteredFriends();
    if($this->assertEqual(count($friends), 1))
      $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  function testGetPictures()
  {
    $pictures = (new TwitterProfile($this->main_user))->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testGetPictures_PicturesIfDefault()
  {
    // bar should have default avatar
    $pictures = (new TwitterProfile($this->additional_user))->getPictures();
    $this->assertEqual(count($pictures), 0);
  }

  function testGetPictureContents()
  {
    $profile = (new TwitterProfile($this->main_user));
    $pictures = $profile->getPictures();
    $biggest = array_pop($pictures);
    $contents = $profile->getPictureContents($biggest);
    $this->assertTrue($contents);
  }

  function testShareInvitation()
  {
    (new TwitterProfile($this->main_user))->shareInvitation($this->additional_user->getTwitterUid());
  }

  function testShareBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareBeginDay');
    $day->save();

    $provider = (new TwitterProfile($this->main_user));
    $tweet = $provider->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareDayLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareLikeDay');
    $day->save();

    $tweet = (new TwitterProfile($this->main_user))->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $like = $this->generator->dayLike($day);
    $like->save();

    $tweet = (new TwitterProfile($this->additional_user))->shareDayLike($day, $like);
    // if($this->assertTrue(count($tweet))) {
    //   $this->assertTrue($tweet['id']);
    // }
  }

  function testShareMomentAdd()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareAddMoment - Day');
    $day->save();

    (new TwitterProfile($this->main_user))->shareDayBegin($day);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $tweet = (new TwitterProfile($this->main_user))->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $moment = $this->generator->moment($day);
    $moment->save();
    $tweet = (new TwitterProfile($this->main_user))->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $tweet = (new TwitterProfile($this->main_user))->shareDayBegin($day);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $like = $this->generator->momentLike($moment);
    $like->save();

    $tweet = (new TwitterProfile($this->main_user))->shareMomentAdd($day, $moment);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $tweet = (new TwitterProfile($this->main_user))->shareMomentLike($moment, $like);
    // if($this->assertTrue(count($tweet))) {
    //   $this->assertTrue($tweet);
    // }
  }

  function testShareDayEnd()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareEndDay - Day');
    $day->save();

    $tweet = (new TwitterProfile($this->main_user))->shareDayBegin($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
    $tweet = (new TwitterProfile($this->main_user))->shareDayEnd($day);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $tweet = (new TwitterProfile($this->main_user))->shareDay($day);
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
