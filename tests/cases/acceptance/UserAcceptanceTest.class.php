<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class UserAcceptanceTest extends odAcceptanceTestCase
{

  /**
   *@example
   */
  function testDays()
  {
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $days = $this->get('users/'.$this->additional_user->getId().'/days')->result;
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
}
