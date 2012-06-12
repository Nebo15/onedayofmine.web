<?php
lmb_require('tests/cases/AcceptanceTestCase.class.php');


class ComplaintTest extends AcceptanceTestCase
{
  function testComplaint_Create()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('/complaint/create', array('day_id' => 42, 'text' => 'complaint_text'));
    if($this->assertEqual(200, $res->code))
      $this->assertTrue(property_exists($res->result, 'complaint_id'));
  }

  function testComplaint_Get()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->get('/complaint/get');
    if($this->assertEqual(200, $res->code))
      $this->assertTrue(property_exists($res->result, 'complaint_id'));
  }
}
