<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class FacebookProfileTest extends odIntegrationTestCase
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
    $this->assertEqual($info['uid'], $this->main_user->facebook_uid);
  }

  function testGetInfo()
  {
    $info = (new FacebookProfile($this->main_user))->getInfo();
    $this->assertTrue(count($info));
    $this->assertEqual($info['facebook_uid'], $this->main_user->facebook_uid);
  }

  function testGetFriends()
  {
    $friends = (new FacebookProfile($this->additional_user))->getFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]['facebook_uid'], $this->main_user->facebook_uid);
  }

  function testGetRegisteredFriends()
  {
    $friends = (new FacebookProfile($this->main_user))->getRegisteredFriends();
    $this->assertEqual(0, count($friends));

    $this->additional_user->save();

    $friends = (new FacebookProfile($this->main_user))->getRegisteredFriends();
    $this->assertEqual(count($friends), 1);
    $this->assertEqual($friends[0]->id, $this->additional_user->id);
  }

  function testGetPictures()
  {
    $pictures = (new FacebookProfile($this->additional_user))->getPictures();
    $this->assertTrue(count($pictures));
  }

  function testGetPictures_PicturesIfDefault()
  {
    // foo should have default avatar
    $pictures = (new FacebookProfile($this->main_user))->getPictures();
    $this->assertEqual(count($pictures), 0);
  }

  function testGetPictureContents()
  {
    // Bar should have not-default avatar
    $profile = (new FacebookProfile($this->additional_user));
    $pictures = $profile->getPictures();
    $biggest = array_pop($pictures);
    $contents = $profile->getPictureContents($biggest);
    $this->assertTrue($contents);
  }

  function testShareInvitation()
  {
    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareInvitation($this->additional_user->facebook_uid);
    $this->assertTrue($facebook_id);
  }

  function testShareBeginDay()
  {
    $day = $this->generator->day();
    $day->title ='testShareBeginDay';
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    $facebook_id = (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    $this->assertTrue($facebook_id);
  }

  function testShareDayLike()
  {
    $day = $this->generator->day();
    $day->title ='testShareLikeDay';
    $day->save();

    $like = $this->generator->dayLike($day);
    $like->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    (new FacebookProfileForTests($this->additional_user))->shareDayLike($day, $like);
  }

  function testShareAddMoment()
  {
    $day = $this->generator->day();
    $day->title ='testShareAddMoment - Day';
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
    $day->title ='testShareMomentLike - Day';
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

    $like = $this->generator->momentLike($moment);
    $like->save();

    (new FacebookProfileForTests($this->main_user))->shareMomentLike($moment, $like);
  }

  function testShareDay()
  {
    $day = $this->generator->day();
    $day->title ='shareDay - Day';
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDay($day);
  }

  function testShareEndDay()
  {
    $day = $this->generator->day();
    $day->title ='testShareEndDay - Day';
    $day->save();

    $this->proxy_client->copyObjectPageToProxy($this->toolkit->getPagePath($day));

    (new FacebookProfileForTests($this->main_user))->shareDayBegin($day);
    (new FacebookProfileForTests($this->main_user))->shareDayEnd($day);
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
