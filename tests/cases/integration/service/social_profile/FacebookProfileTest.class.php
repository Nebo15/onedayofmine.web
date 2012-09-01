<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');

class FacebookProfileTest extends odAcceptanceTestCase
{
  /**
   * @var Client
   */
  protected $proxy_client;

  function setUp()
  {
    parent::setUp();
    $this->proxy_client = new Client('http://stage.onedayofmine.com/proxy.php', 'http://onedayofmine.dev/');
  }

  function testGetInfoRaw()
  {
    $info = (new FacebookProfile($this->main_user))->getInfo_Raw();
    $this->assertTrue(count($info));
    $this->assertEqual($info['uid'], $this->main_user->getFacebookUid());
  }

  function testGetInfo()
  {
    $info = (new FacebookProfile($this->main_user))->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['facebook_uid'], $this->main_user->getFacebookUid());
  }

  function testGetFriends()
  {
    $friends = (new FacebookProfile($this->additional_user))->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['uid'], $this->main_user->getFacebookUid());
  }

  function testGetRegisteredFriends()
  {
    $friends = (new FacebookProfile($this->main_user))->getRegisteredFriends();
    $this->assertEqual(0, count($friends));

    $this->additional_user->save();

    $friends = (new FacebookProfile($this->main_user))->getRegisteredFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]->getId(), $this->additional_user->getId());
  }

  function testGetPictures()
  {
    $pictures = (new FacebookProfile($this->main_user))->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testGetPictures_PicturesIfDefault()
  {
    // foo should have default avatar
    $pictures = (new FacebookProfile($this->additional_user))->getPictures();
    $this->assertEqual(count($pictures), 0);
  }

  function testGetPictureContents()
  {
    $profile = (new FacebookProfile($this->main_user));
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

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    $this->assertTrue($facebook_id);
  }

  function testShareDayLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareLikeDay');
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    (new FacebookProfileForTests($this->additional_user))->shareDayLike($day);
  }

  function testShareAddMoment()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareAddMoment - Day');
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    $day->setFacebookId($facebook_id);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($moment));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareMomentAdd($day, $moment);
    $this->assertTrue($facebook_id);

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($moment));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareMomentAdd($day, $moment);
    $this->assertTrue($facebook_id);
  }

  function testShareMomentLike()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareMomentLike - Day');
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    $day->setFacebookId($facebook_id);
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    $moment = $this->generator->moment($day);
    $moment->save();
    $moment->attachImage($this->generator->image());
    $moment->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($moment));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareMomentAdd($day, $moment);
    $this->assertTrue($facebook_id);

    (new FacebookProfileForTests($this->main_user))->shareMomentLike($moment);
  }

  function testShareEndDay()
  {
    $day = $this->generator->day();
    $day->setTitle('testShareEndDay - Day');
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    (new FacebookProfileForTests($this->main_user))->shareDayEnd($day);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->setTitle('shareDay - Day');
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDay($day);
  }
}

class FacebookProfileForTests extends FacebookProfile
{
  protected function _getPageUrl($object)
  {
    $page_url = parent::_getPageUrl($object);
    return str_replace('onedayofmine.dev', 'stage.onedayofmine.com', $page_url);
  }
}
