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
   *@public
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

    $loaded_complaint = Complaint::find()->at(0);
    $this->assertProperty($res->result, 'id');
    $this->assertEqual($loaded_complaint->getId(), $res->result->id);
    $this->assertEqual($loaded_complaint->getText(), $text);
  }
}
