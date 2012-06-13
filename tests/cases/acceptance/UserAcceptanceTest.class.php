<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class UserAcceptanceTest extends odAcceptanceTestCase
{
  function testUser_Days()
  {
    $this->_loginAndSetCookie($this->main_user);

    $days = $this->get('user/days')->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->img_url);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
  }

  function testUser_FiendsWithApp()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $result = $this->get('user/friends_in_app');
    $friends = $result->result;
    $this->assertResponse(200);
    $this->assertTrue(is_array($friends));
    $this->assertEqual(1, count($friends));
    $this->assertEqual($friends[0]->fb_uid, $this->additional_user->getFbUid());
  }
}
