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
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('moment/update', array(
      'moment_id' => $moment->getId(),
      'description' => $desc = $this->generator->string(255))
    )->result;
    $this->assertResponse(200);
    $this->assertEqual($res->description, $desc);
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
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $moment->attachImage($this->generator->image_name(), $this->generator->image());
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('moment/share', array('moment_id' => $moment->getId()))->result;
    $this->assertResponse(200);

    $this->assertTrue($res);
    $this->assertProperty($res, 'id');
    $this->assertTrue($res->id);
  }
}
