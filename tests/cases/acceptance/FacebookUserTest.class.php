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

    $path = '/pages/'.$day->getId().'/day';

    $this->createProxyClient()->copyObjectPageToProxy($path);

    $this->main_user->getFacebookUser()->beginDay($this->proxy_host.$path);
  }

  function testLikeDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testLikeDay');
    $day->save();

    $path = '/pages/'.$day->getId().'/day';

    $this->createProxyClient()->copyObjectPageToProxy($path);

    $this->main_user->getFacebookUser()->beginDay($this->proxy_host.$path);
    $this->additional_user->getFacebookUser()->likeDay($this->proxy_host.$path);
  }

  function testAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testAddMoment - Day');
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->setDescription('testAddMoment');
    $moment->save();

    $day_path = '/pages/'.$day->getId().'/day';
    $this->createProxyClient()->copyObjectPageToProxy($day_path);

    $this->main_user->getFacebookUser()
      ->beginDay($this->proxy_host.$day_path);
    $this->main_user->getFacebookUser()
      ->addMoment($moment, $this->proxy_host.$day_path);
  }


  function testEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testEndDay - Day');
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->setDescription('testEndDay');
    $moment->save();

    $day_path = '/pages/'.$day->getId().'/day';
    $this->createProxyClient()->copyObjectPageToProxy($day_path);

    $this->main_user->getFacebookUser()
      ->beginDay($this->proxy_host.$day_path);

    $this->main_user->getFacebookUser()
      ->endDay($this->proxy_host.$day_path);
  }

  /**
   * @return Client
   */
  protected function createProxyClient()
  {
    return new Client($this->proxy_host.'/proxy.php', lmb_env_get('HOST_NAME'));
  }
}
