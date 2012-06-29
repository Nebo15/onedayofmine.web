<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class UserAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
   */
  function testDays_CurrentUser()
  {
    $this->_loginAndSetCookie($this->main_user);

    $days = $this->get('user/days/')->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
  }

  /**
   *@example
   */
  function testDays_AnotherUser()
  {
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $days = $this->get('user/days/'.$this->additional_user->getId())->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
  }

  //@TODO
  function testDays_UserNotFound() {}

  /**
   *@example
   */
  function testFiendsWithApp()
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
