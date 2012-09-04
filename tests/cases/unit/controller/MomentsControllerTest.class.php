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

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('comment',
      array('text' => $text = $this->generator->string(255)),
      $moment->getId()
    )->result;

    $this->assertResponse(200);
    $this->assertEqual($moment->getComments()->at(0)->getId(), $res->id);
    $this->assertEqual($moment->getId(), $res->moment_id);
    $this->assertEqual($text, $res->text);
  }

  // TODO
  function testComment_MomentNotFound() {}

  /**
   * @api
   */
  function testLike() {
    $moment = $this->generator->moment();
    $moment->save();

    $this->assertEqual(MomentLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('like', array(), $moment->getId());

    $this->assertResponse(200);
    $this->assertEqual(MomentLike::find()->count(), 1);
    $this->assertEqual(Moment::findOne()->getLikes()->count(), 1);
  }

  function testLike_OwnDay() {
    $day = $this->generator->day($this->additional_user);
    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);
    $this->post('like', array(), $moment->getId());

    $this->assertResponse(400);
  }

  /**
   * @api
   */
  function testUnlike() {
    $moment = $this->generator->moment();
    $moment->save();

    $like = $this->generator->momentLike($moment, $this->additional_user);
    $like->save();

    $this->assertEqual(MomentLike::find()->count(), 1);

    lmbToolkit::instance()->setUser($this->additional_user);
    $this->post('unlike', array(), $moment->getId());

    $this->assertResponse(200);
    $this->assertEqual(MomentLike::find()->count(), 0);
  }
}
