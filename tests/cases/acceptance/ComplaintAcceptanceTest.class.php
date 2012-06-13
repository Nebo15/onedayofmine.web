<?php
lmb_require('tests/cases/AcceptanceTestCase.class.php');


class ComplaintAcceptanceTest extends AcceptanceTestCase
{
  function testComplaint_Create()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('/complaint/create', array('day_id' => 42, 'text' => 'complaint_text'));
    $this->assertResponse(200);
    if($this->assertEqual(200, $res->code))
    {
      $this->assertProperty($res->result, 'complaint_id');
      $this->assertEqual(222, $res->result->complaint_id);
    }
  }

  function testComplaint_Get()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->get('/complaint/get');
    if($this->assertEqual(200, $res->code))
    {
      $this->assertTrue(is_array($res->result));
      $this->assertProperty($res->result[0], 'text');
      $this->assertProperty($res->result[0], 'day_id');
      $this->assertProperty($res->result[0], 'moment_id');
    }
  }
}
