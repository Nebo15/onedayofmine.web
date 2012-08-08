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
   * @api description Updates information about specified <a href="#Entity:Moment">moment</a> and returns it.
   * @api input option string description
   * @api input option string image_content File contents, that was previously encoded by base64
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
      'image_content' => base64_encode($this->generator->image()),
      ))->result;
    $this->assertResponse(200);

    $this->assertEqual($res->description, $desc);
    $this->assertProperty($res, 'image_266');
    $content = @file_get_contents($res->image_266);
    $this->assertTrue($content, "Image {$res->image_266} not found");
    $this->assertProperty($res, 'image_532');
    $content = @file_get_contents($res->image_532);
    $this->assertTrue($content, "Image {$res->image_532} not found");

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  // TODO
  function testUpdate_MomentNotFound() {}

  /**
   * @api description Delete a moment.
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

  // TODO
  function testDelete_WrongUser() {}

  // TODO
  function testDelete_MomentNotFound() {}

  /**
   * @api description Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.
   * @api input param string text
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

  // TODO
  function testComment_MomentNotFound() {}

  // TODO-high
  function testLike() {}
}
