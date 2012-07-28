<?php
lmb_require('tests/cases/odUnitTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class FacebookUserTest extends odUnitTestCase
{
  protected $proxy_host = 'http://onedayofmine.com/';

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
