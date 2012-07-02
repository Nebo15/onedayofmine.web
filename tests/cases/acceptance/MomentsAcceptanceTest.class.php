<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class MomentsAcceptanceTest extends odAcceptanceTestCase
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
    $res = $this->post('moments/'.$moment->getId().'/update', array(
      'description' => $desc = $this->generator->string(255))
    )->result;
    $this->assertResponse(200);

    $this->assertEqual($res->description, $desc);

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  //todo
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
    $this->post('moments/'.$moment->getId().'/delete');

    $this->assertResponse(200);
    $this->assertFalse(Moment::findById($moment->getId()));
  }

  //todo
  function testDelete_WrongUser() {}

  //todo
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
    $res = $this->post('moments/'.$moment->getId().'/comment', array(
      'text' => $text = $this->generator->string(255)
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual($moment->getComments()->at(0)->getId(), $res->id);
    $this->assertEqual($moment->getId(), $res->moment_id);
    $this->assertEqual($text, $res->text);
  }

  //todo
  function testComment_MomentNotFound() {}

  //todo-high
  function testLike() {}
}
