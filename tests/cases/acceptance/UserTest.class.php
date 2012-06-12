<?php
lmb_require('tests/cases/AcceptanceTestCase.class.php');


class UserTest extends AcceptanceTestCase
{
  function testUser_Days()
  {

  }

  function testUser_FiendsWithApp()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_login($this->main_user);
    $response = $this->get('user/friends_in_app');
    $this->assertTrue(is_array($response->friends));
    $this->assertEqual(1, count($response->friends));
    $this->assertEqual($response->friends[0]->fb_uid, $this->additional_user->getFbUid());
  }
}
