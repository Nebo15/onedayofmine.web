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
   * @api
   */
  function testUpdate()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('moments/'.$moment->getId().'/update', array(
      'description' => $desc = $this->generator->string(255),
      'img_name' => $this->generator->image_name(),
      'img_content' => base64_encode($this->generator->image()),
      ))->result;
    $this->assertResponse(200);

    $this->assertEqual($res->description, $desc);
    $this->assertProperty($res, 'img_small');
    $content = @file_get_contents($res->img_small);
    $this->assertTrue($content, "Image {$res->img_small} not found");
    $this->assertProperty($res, 'img_big');
    $content = @file_get_contents($res->img_big);
    $this->assertTrue($content, "Image {$res->img_big} not found");

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  //TODO
  function testUpdate_MomentNotFound() {}

  /**
   * @api
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
   * @api
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
