<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MomentsController.class.php');
lmb_require('src/model/Day.class.php');

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

    $moment = $this->generator->momentWithImage($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('update', [
        'description'   => $description = $this->generator->string(255),
        'time'          => $time        = "2005-08-09T18:31:42+03:00",
        'image_content' => $image       = base64_encode($this->generator->image()),
    ], $moment->id);
    if($this->assertResponse(200))
    {
      $response_moment = $response->result;
      $this->assertJsonMoment($response_moment, true);

      $loaded_moment = Moment::findById($moment->id);
      $this->assertEqual($loaded_moment->getDescription(), $description);
    }
  }

  function testUpdate_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('update', [
        'description' => $this->generator->string(255),
        'time' => "2005-08-09T18:31:42+03:00",
        'image_content' => base64_encode($this->generator->image()),
    ], $id = $this->generator->integer());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Moment with id='{$id}' not found");
    }
  }

  function testUpdate_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('update', [
        'description' => $desc = $this->generator->string(255),
        'time' => $time = "2005-08-09T18:31:42+03:00",
        'image_content' => base64_encode($this->generator->image()),
    ], $moment->id);
    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Current user don't have permission to perform this action");
    }
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

    $response = $this->post('delete', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual($day->getMoments()->count(), 0);
    }
  }

  function testDelete_WrongUser()
  {
    $moment = $this->generator->moment();
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $moment->id);
    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Current user don't have permission to perform this action");
    }
  }

  function testDelete_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $id = $this->generator->integer());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(count($response->errors), 0);
    }
  }

  function testRestore()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->is_deleted = 1;
    $moment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $loaded_moment = Moment::findFirst();
    $this->assertEqual(1, $loaded_moment->is_deleted);
    $this->assertEqual($day->getMoments()->count(), 0);

    $response = $this->post('restore', [], $moment->id)->result;
    if($this->assertResponse(200))
    {
      $loaded_moment = Moment::findFirst();
      $this->assertEqual(0, $loaded_moment->is_deleted);
      $this->assertEqual($day->getMoments()->count(), 1);
    }
  }

  function testComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('comment', [
      'text' => $text = $this->generator->string(50)
    ], $moment->id);
    if($this->assertResponse(200))
    {
      $response_comment = $response->result;
      $this->assertJsonMomentComment($response_comment);

      $loaded_comment = MomentComment::findFirst();
      $exported   = $this->toolkit->getExportHelper()->exportMomentComment($loaded_comment);
      $this->assertJsonMomentComment($exported);

      $this->assertEqualPropertyValues($exported, $response_comment);
    }
  }

  function testComment_MomentNotFound()
  {
    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('comment', [
      'text' => $text = $this->generator->string(50),
    ], $id = $this->generator->integer());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Moment with id='$id' not found");
    }
  }

  /**
   * @api description Creates <a href="#Entity:MomentComment">moment comment</a> and returns it.
   * @api input param string text
   */
  function testComments()
  {
    $day = $this->generator->dayWithComments();
    $day->save();

    $moment = $this->generator->moment($day, true);
    $moment->save();

    $loaded_comments = $moment->getComments();

    $response = $this->get('comments', [], $moment->id);
    if($this->assertResponse(200))
    {
      $response_comments = $response->result;
      $this->assertEqual(4, count($response_comments));
      $this->assertJsonDayCommentItems($response_comments);

      for($i = 0; $i < count($response_comments); $i++)
      {
        $this->assertEqual($loaded_comments->at($i)->id,   $response_comments[$i]->id);
        $this->assertEqual($loaded_comments->at($i)->text, $response_comments[$i]->text);
      }
    }

    $response_with_from = $this->get('comments', [
      'from' => $loaded_comments->at(0)->id,
    ], $moment->id);
    if($this->assertResponse(200))
    {
      $response_comments = $response_with_from->result;
      $this->assertEqual(3, count($response_comments));
      $this->assertJsonDayCommentItems($response_comments);

      for($i = 0; $i < count($response_comments); $i++)
      {
        $this->assertEqual($loaded_comments->at($i+1)->id,   $response_comments[$i]->id);
        $this->assertEqual($loaded_comments->at($i+1)->text, $response_comments[$i]->text);
      }
    }

    $response_with_range = $this->get('comments', [
      'from' => $loaded_comments->at(0)->id,
      'to'   => $loaded_comments->at(3)->id,
    ], $moment->id);
    if($this->assertResponse(200))
    {
      $response_comments = $response_with_range->result;
      $this->assertEqual(2, count($response_comments));
      $this->assertJsonDayCommentItems($response_comments);

      for($i = 0; $i < count($response_comments); $i++)
      {
        $this->assertEqual($loaded_comments->at($i+1)->id,   $response_comments[$i]->id);
        $this->assertEqual($loaded_comments->at($i+1)->text, $response_comments[$i]->text);
      }
    }

    $response_with_limit = $this->get('comments', [
      'from'  => $moment->getComments()->at(0)->id,
      'to'    => $moment->getComments()->at(3)->id,
      'limit' => 1,
    ], $moment->id);
    if($this->assertResponse(200))
    {
      $response_comments = $response_with_limit->result;
      $this->assertEqual(1, count($response_comments));
      $this->assertJsonDayCommentItems($response_comments);

      $this->assertEqual($loaded_comments->at(1)->id,   $response_comments[0]->id);
      $this->assertEqual($loaded_comments->at(1)->text, $response_comments[0]->text);
    }
  }

  /**
   * @api
   */
  function testLike()
  {
    $moment = $this->generator->moment();
    $moment->save();

    $this->assertEqual(MomentLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('like', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(MomentLike::find()->count(), 1);
      $this->assertEqual(Moment::findFirst()->getLikes()->count(), 1);
    }
  }

  function testLike_TwoTimes()
  {
    $moment = $this->generator->moment();
    $moment->save();

    $this->assertEqual(MomentLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('like', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(MomentLike::find()->count(), 1);
      $this->assertEqual(Moment::findFirst()->getLikes()->count(), 1);
    }

    $response = $this->post('like', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual($response->status, 'Entity already exists');
    }
  }

  function testLike_OwnDay()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('like', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(MomentLike::find()->count(), 1);
      $this->assertEqual(Moment::findFirst()->getLikes()->count(), 1);
    }
  }

  /**
   * @api
   */
  function testUnlike()
  {
    $moment = $this->generator->moment();
    $moment->save();

    $like = $this->generator->momentLike($moment, $this->additional_user);
    $like->save();

    $this->assertEqual(MomentLike::find()->count(), 1);

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('unlike', [], $moment->id);
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(MomentLike::find()->count(), 0);
    }
  }
}
