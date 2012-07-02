<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class UserTest extends odUnitTestCase
{
  function testGetUserInfo()
  {
    $info = $this->main_user->getUserInfo();
    $this->assertTrue(isset($info['fb_uid']));
    $this->assertTrue(isset($info['fb_name']));
    $this->assertTrue(isset($info['pic_small']));
    $this->assertTrue(isset($info['pic_square']));
    $this->assertTrue(isset($info['pic_big']));
    $this->assertTrue(isset($info['fb_profile_url']));
  }

  function testGetUserFriendsInApplicationFromFb()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $friends = $this->main_user->getUserFriendsInApplicationFromFb();
    if($this->assertEqual(1, count($friends)))
      $this->assertEqual($this->additional_user->getId(), $friends[0]->getId());
  }
}
