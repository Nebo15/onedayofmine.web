<?php
lmb_require('tests/cases/odUnitTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class TwitterUserTest extends odUnitTestCase
{
  protected $proxy_host = 'http://onedayofmine.com';

  public function setUp()
  {
    parent::setUp();

    $this->main_user->setTwitterUid($this->generator->twitter_credentials()[1]['uid']);
    $this->main_user->setTwitterAccessToken($this->generator->twitter_credentials()[1]['access_token']);
    $this->main_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[0]['access_token_secret']);
    $this->main_user->save();

    $this->additional_user->setTwitterUid($this->generator->twitter_credentials()[0]['uid']);
    $this->additional_user->setTwitterAccessToken($this->generator->twitter_credentials()[0]['access_token']);
    $this->additional_user->setTwitterAccessTokenSecret($this->generator->twitter_credentials()[1]['access_token_secret']);
    $this->additional_user->save();
  }

  function testTweet()
  {
    $text = $this->generator->string();
    $social_profile= $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER);
    $tweet = $social_profile->tweet($text);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
      $this->assertEqual($text, $tweet->text);
    }

    $twitter = lmbToolkit::instance()->getSocialServices()->getTwitter(
      $this->main_user->getTwitterAccessToken(),
      $this->main_user->getTwitterAccessTokenSecret()
    );

    // sleep(5);
    // $response = $twitter->api('1/statuses/user_timeline')[0];
    // $this->assertEqual($response->id, $tweet->id);
    // $this->assertEqual($response->text, $tweet->text);
    // $this->assertEqual($response->user->id, $tweet->user->id);
  }


  function testBeginDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testBeginDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $provider = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER);
    $tweet = $provider->shareDayBegin($day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
    $tweet = $this->additional_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayLike($day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    // $day->setFbId($tweet); TODO
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    // $day->setFbId($tweet); TODO
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment_url = $this->_copyMomentPageToProxy($moment);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentAdd($moment_url, $day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareMomentLike($moment_url);
    $this->assertTrue($tweet);
  }

  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();
    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayBegin($day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDayEnd($day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $day_url = $this->_copyDayPageToProxy($day);

    $tweet = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_TWITTER)->shareDay($day, $day_url);
    if($this->assertTrue($tweet instanceof stdObject)) {
      $this->assertTrue($tweet->id);
    }
  }

  protected function _copyDayPageToProxy(Day $day)
  {
    $path = '/pages/'.$day->getId().'/day';
    $this->_createProxyClient()->copyObjectPageToProxy($path);
    return $this->proxy_host.$path;
  }

  protected function _copyMomentPageToProxy(Moment $moment)
  {
    $path = '/pages/'.$moment->getId().'/moment';
    $this->_createProxyClient()->copyObjectPageToProxy($path);
    return $this->proxy_host.$path;
  }

  /**
   * @return Client
   */
  protected function _createProxyClient()
  {
    return new Client($this->proxy_host.'/proxy.php', lmb_env_get('HOST_NAME'));
  }
}
