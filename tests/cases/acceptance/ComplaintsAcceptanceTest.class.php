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
   * @api input param int id ID of abused comment
   * @api input param string text Abuse description message
   * @api result int day_id
   * @api result string text
   * @api result int ctime Creation time, unix timestamp
   * @api result int id Complaint ID
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
