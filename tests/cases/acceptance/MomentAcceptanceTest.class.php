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

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  //@TODO
  function testUpdate_MomentNotFound() {}

  /**
   * @example
   */
  function testDelete()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('moment/delete', array('moment_id' => $moment->getId()));

    $this->assertResponse(200);
    $this->assertFalse(Moment::findById($moment->getId()));
  }

  //@TODO
  function testDelete_WrongUser() {}

  //@TODO
  function testDelete_MomentNotFound() {}

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

  //@TODO
  function testComment_MomentNotFound() {}

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

  //@TODO
  function testShare_MomentNotFound() {}
}
