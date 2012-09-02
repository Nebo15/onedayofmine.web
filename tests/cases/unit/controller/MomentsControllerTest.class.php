<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MomentsController.class.php');

class MomentsControllerTest extends odControllerTestCase
{
  protected $controller_class = 'MomentsController';

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

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('update',
      array(
        'description' => $desc = $this->generator->string(255),
        'image_content' => base64_encode($this->generator->image()),
      ),
      $moment->getId()
    )->result;
    $this->assertResponse(200);

    $this->assertEqual($res->description, $desc);
    $this->assertProperty($res, 'image_266');
    $this->assertValidImageUrl($res->image_266);
    $this->assertValidImageUrl($res->image_532);

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  // TODO
  function testUpdate_MomentNotFound()
  {

  }

  /**
   * @api description Delete a moment.
   */
  function testDelete()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), $moment->getId());

    $this->assertResponse(200);
    $this->assertFalse(Moment::findById($moment->getId()));
  }

  function testDelete_WrongUser()
  {
    $moment = $this->generator->moment();
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), $moment->getId());

    $this->assertResponse(404);
  }

  function testDelete_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), 100500);
    $this->assertResponse(404);
  }

  /**
   * @api description Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.
   * @api input param string text
   */
  function testComments()
  {
    $day = $this->generator->day(null, true);
    $day->save();
    $moment = $this->generator->moment($day, true);
    $moment->save();

    $res = $this->get('comments', array(), $moment->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($res));
    $this->assertEqual($moment->getComments()->at(0)->id, $res[0]->id);
    $this->assertEqual($moment->getComments()->at(0)->text, $res[0]->text);
    $this->assertEqual($moment->getComments()->at(0)->user->exportForApi(), $res[0]->user);
    $this->assertEqual($moment->getComments()->at(1)->id, $res[1]->id);
    $this->assertEqual($moment->getComments()->at(2)->id, $res[2]->id);
    $this->assertEqual($moment->getComments()->at(3)->id, $res[3]->id);

    $res = $this
      ->get('comments', array(
      'from' => $moment->getComments()->at(0)->id
    ), $moment->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($res));
    $this->assertEqual($moment->getComments()->at(1)->id, $res[0]->id);
    $this->assertEqual($moment->getComments()->at(2)->id, $res[1]->id);
    $this->assertEqual($moment->getComments()->at(3)->id, $res[2]->id);

    $res = $this
      ->get('comments', array(
      'from' => $moment->getComments()->at(0)->id,
      'to' => $moment->getComments()->at(3)->id,
    ), $moment->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($res));
    $this->assertEqual($moment->getComments()->at(1)->id, $res[0]->id);
    $this->assertEqual($moment->getComments()->at(2)->id, $res[1]->id);

    $res = $this
      ->get('comments', array(
      'from' => $moment->getComments()->at(0)->id,
      'to' => $moment->getComments()->at(3)->id,
      'limit' => 1
    ), $moment->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($res));
    $this->assertEqual($moment->getComments()->at(1)->id, $res[0]->id);
  }

  // TODO
  function testComment_MomentNotFound() {}

  // TODO-high
  function testLike() {}
}
