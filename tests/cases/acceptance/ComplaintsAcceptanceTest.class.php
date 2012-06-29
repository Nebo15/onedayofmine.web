<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class ComplaintsAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Complaint');
  }

  /**
   *@example
   */
  function testCreate()
  {
    $day = $this->generator->day();
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('/complaints/'.$day->getId().'/create', array(
      'text' => $text = $this->generator->string()
    ));
    $this->assertResponse(200);

    $loaded_complaints = Complaint::find();
    $this->assertEqual(1, count($loaded_complaints));

    $this->assertProperty($res->result, 'id');
    $this->assertEqual($loaded_complaints->at(0)->getId(), $res->result->id);
    $this->assertEqual($loaded_complaints->at(0)->getText(), $text);
  }

  /**
   *@example
   */
  function testDisplay()
  {
    $this->_loginAndSetCookie($this->main_user);

    $complaint = $this->generator->complaint();
    $complaint->save();

    $res = $this->get('/complaints/');

    $this->assertResponse(200);
    $this->assertTrue(is_array($res->result));
    $this->assertEqual(1, count($res->result));
    $this->assertEqual($complaint->getId(), $res->result[0]->id);
    $this->assertEqual($complaint->getDayId(), $res->result[0]->day_id);
    $this->assertEqual($complaint->getCreateTime(), $res->result[0]->ctime);
    $this->assertEqual($complaint->getText(), $res->result[0]->text);
  }
}
