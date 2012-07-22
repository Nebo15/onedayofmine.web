<?php
lmb_require('tests/cases/odUnitTestCase.class.php');
lmb_require('facebook-proxy/src/Client.php');

class FacebookUserTest extends odUnitTestCase
{
  protected $proxy_host = 'http://onedayofmine.com/';

  function testBeginDay()
  {
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->setTitle('testBeginDay');
    $day->save();

    $path = '/pages/'.$day->getId().'/day';

    $this->createProxyClient()->copyObjectPageToProxy($path);

    $this->main_user->getFacebookUser()->beginDay($this->proxy_host.$path);
  }

  function testShareDay()
  {
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->setTitle('testShareDay');
    $day->save();

    $path = '/pages/'.$day->getId().'/day';

    $this->createProxyClient()->copyObjectPageToProxy($path);

    $this->additional_user->getFacebookUser()->shareDay($day, $this->proxy_host.$path);
  }

  function testLikeDay()
  {
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->setTitle('testLikeDay');
    $day->save();

    $path = '/pages/'.$day->getId().'/day';

    $this->createProxyClient()->copyObjectPageToProxy($path);

    $this->main_user->getFacebookUser()->beginDay($this->proxy_host.$path);

    $this->additional_user->getFacebookUser()->likeDay($this->proxy_host.$path);
  }

  /**
   * @return Client
   */
  protected function createProxyClient()
  {
    return new Client($this->proxy_host.'/proxy.php', lmb_env_get('HOST_NAME'));
  }
}
