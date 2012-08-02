<?php
lmb_require('tests/cases/odUnitTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class TwitterProfileTest extends odUnitTestCase
{

  public function setUp()
  {
    parent::setUp();

    $this->main_user->setTwitterUid($this->generator->twitter_credentials()[0]['uid']);
    $this->main_user->setTwitterAccessToken($this->generator->twitter_credentials()[0]['access_token']);
    $this->main_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[0]['access_token_secret']);
    $this->main_user->save();

    $this->additional_user->setTwitterUid($this->generator->twitter_credentials()[1]['uid']);
    $this->additional_user->setTwitterAccessToken($this->generator->twitter_credentials()[1]['access_token']);
    $this->additional_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[1]['access_token_secret']);
    $this->additional_user->save();
  }

  function testGetInfoRaw()
  {
    $info = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['id'], $this->main_user->getTwitterUid());
  }

  function testGetInfo()
  {
    $info = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['twitter_uid'], $this->main_user->getTwitterUid());
  }

  function testGetFriendsIds()
  {
    $ids = $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->getFriendsIds();
    $this->assertEqual(count($ids), 1);
    $this->assertEqual($ids[0], $this->main_user->getTwitterUid());
  }

  function testGetFriends()
  {
    $friends = $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['id'], $this->main_user->getTwitterUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->getRegisteredFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  // TODO duplicate tweeting workaround must be fixed
  function estTweet()
  {
    $text = $this->generator->string();
    $social_profile = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER);
    $tweet = $social_profile->tweet($text);

    $response = json_decode($social_profile->getProvider()->response['response'], true);
    // Workaround for duplicate tweets
    if(array_key_exists('error', $response) && $response['error'] == 'Status is a duplicate.')
      return;

    $this->assertTrue(is_array($tweet));
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
      $this->assertEqual($text, $tweet['text']);
    }

    // sleep(5);
    // $twitter = lmbToolkit::instance()->getSocialServices()->getTwitter(
    //   $this->main_user->getTwitterAccessToken(),
    //   $this->main_user->getTwitterAccessTokenSecret()
    // );
    // $response = $twitter->api('1/statuses/user_timeline')[0];
    // $this->assertEqual($response['id'], $tweet['id']);
    // $this->assertEqual($response['text'], $tweet['text']);
    // $this->assertEqual($response->user['id'], $tweet->user['id']);
  }


  function testBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testBeginDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $provider = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER);
    $tweet = $provider->shareDayBegin($day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
    $tweet = $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayLike($day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentLike($moment_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet);
    }
  }

  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayEnd($day_url);
    if($this->assertTrue(count($tweet))) {
      $this->assertTrue($tweet['id']);
    }
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDay($day, $day_url);
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
