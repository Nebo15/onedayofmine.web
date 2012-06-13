<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class UserTest extends odUnitTestCase
{
  /**
   * @var User
   */
  protected $main_user;
  /**
   * @var User
   */
  protected $additional_user;

  function setUp()
  {
    parent::setUp();
    User::delete();
    lmbToolkit::instance()->getDefaultDbConnection()->commitTransaction();
    list($this->main_user, $this->additional_user) = FbForTests::getUsers();
  }

  function testLoadUserInfoFromFb()
  {
    $info = $this->main_user->loadUserInfoFromFb();
    $this->assertTrue(isset($info['fb_uid']));
    $this->assertTrue(isset($info['fb_name']));
    $this->assertTrue(isset($info['pic_small']));
    $this->assertTrue(isset($info['pic_square']));
    $this->assertTrue(isset($info['pic_big']));
    $this->assertTrue(isset($info['fb_profile_url']));
  }

  function testGetGetUserFriendsInApplicationFromFb()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $friends = $this->main_user->getGetUserFriendsInApplicationFromFb();
    $this->assertEqual(1, count($friends));
    $this->assertEqual($this->additional_user->getId(), $friends[0]->getId());
  }
}
