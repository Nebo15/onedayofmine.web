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
}
