<?php

class UserTest extends UnitTestCase
{
  /**
   * @property [User]
   */
  protected $users;

  function __construct()
  {
    $this->users = FbForTests::getTestUsers();
  }

  function testLoadUserInfoFromFb()
  {
    $info = $this->users[0]->loadUserInfoFromFb();
    $this->assertTrue(isset($info['fb_uid']));
    $this->assertTrue(isset($info['fb_name']));
    $this->assertTrue(isset($info['pic_small']));
    $this->assertTrue(isset($info['pic_square']));
    $this->assertTrue(isset($info['pic_big']));
    $this->assertTrue(isset($info['fb_profile_url']));
  }

  function testGetGetUserFriendsInApplicationFromFb()
  {
    $this->users[0]->save();
    $this->users[1]->save();

    $friends = $this->users[0]->getGetUserFriendsInApplicationFromFb();
    $this->assertEqual(1, count($friends));
  }
}
