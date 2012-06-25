<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class MomentAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Moment', 'MomentComment');
  }

  /**
   * @example
   */
  function testUpdate()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/update');
    $this->assertResponse(200);
  }

  /**
   * @example
   */
  function testDelete()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/delete');
    $this->assertResponse(200);
  }

  /**
   * @example
   */
  function testComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('moment/comment', array(
      'moment_id' => $moment->getId(),
      'text' => $text = $this->generator->string(255)
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual(1, $res->id);
    $this->assertEqual($day->getId(), $res->moment_id);
    $this->assertEqual($text, $res->text);
  }

  /**
   * @example
   */
  function testShare()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/share');
    $this->assertResponse(200);
  }
}
