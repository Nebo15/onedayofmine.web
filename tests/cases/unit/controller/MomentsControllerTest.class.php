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

    $moment = $this->generator->moment($day, true);
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('update',
      array(
        'description' => $desc = $this->generator->string(255),
        'time' => $time = "2005-08-09T18:31:42+03:00",
        'image_content' => base64_encode($this->generator->image()),
      ),
      $moment->getId()
    )->result;
    $this->assertResponse(200);

    $this->assertEqual($res->id, $moment->id);
    $this->assertEqual($res->time, $time);
    $this->assertEqual($res->description, $desc);
    $this->assertValidImageUrl($res->image_266);
    $this->assertValidImageUrl($res->image_532);
    $this->assertEqual($res->likes_count, 0);
    $this->assertEqual($res->comments_count, $moment->getComments()->count());

    $loaded_moment = Moment::findById($moment->getId());
    $this->assertEqual($loaded_moment->getDescription(), $desc);
  }

  function testUpdate_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('update',
      array(
        'description' => $this->generator->string(255),
        'time' => "2005-08-09T18:31:42+03:00",
        'image_content' => base64_encode($this->generator->image()),
      ),
      100500
    );
    $this->assertResponse(404);
  }

  function testUpdate_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);
    $res = $this->post('update',
      array(
        'description' => $desc = $this->generator->string(255),
        'time' => $time = "2005-08-09T18:31:42+03:00",
        'image_content' => base64_encode($this->generator->image()),
      ),
      $moment->getId()
    )->result;
    $this->assertResponse(401);
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
    $this->assertEqual($day->getMoments()->count(), 0);
  }

  function testDelete_WrongUser()
  {
    $moment = $this->generator->moment();
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), $moment->getId());

    $this->assertResponse(401);
  }

  function testDelete_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), 100500);
    $this->assertResponse(404);
  }

  // function testRestore()
  // {
  //   $day = $this->generator->day($this->main_user);
  //   $day->save();

  //   $moment = $this->generator->moment($day);
  //   $moment->setIsDeleted(1);
  //   $moment->save();

  //   lmbToolkit::instance()->setUser($this->main_user);
  //   $this->post('restore', array(), $moment->getId())->result;

  //   $this->assertResponse(200);

  //   $loaded_moment = Moment::findById($day->getId());
  //   $this->assertEqual(0, $loaded_moment->getIsDeleted());
  //   $this->assertEqual($day->getMoments()->count(), 1);
  // }

  function testComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);
    $res = $this
      ->post('comment', array('text' => $text = $this->generator->string(50)), $moment->getId())
      ->result;

    $this->assertResponse(200);
    $new_comment = MomentComment::findOne();
    $this->assertEqual($new_comment->id, $res->id);
    $this->assertEqual($text, $res->text);
    $this->assertEqual(lmbToolkit::instance()->getExportHelper()->exportUserItem($this->additional_user), $res->user);
    $this->assertEqual($text, $new_comment->text);
  }

  function testComment_NotFound()
  {
    lmbToolkit::instance()->setUser($this->additional_user);
    $this
      ->post('comment', array('text' => $text = $this->generator->string(50)), 100500)
      ->result;
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
    $this->assertEqual(lmbToolkit::instance()->getExportHelper()->exportUserItem($moment->getComments()->at(0)->user), $res[0]->user);
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

    $this->assertResponse(200);
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
