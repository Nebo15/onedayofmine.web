<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class MomentAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
   */
  function testUpdate()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/update');
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testDelete()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/delete');
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testComment()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/comment');
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testShare()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/share');
    $this->assertResponse(200);
  }
}
