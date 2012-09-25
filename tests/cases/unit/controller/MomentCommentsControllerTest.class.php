<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MomentCommentsController.class.php');

class MomentCommentsControllerTest extends odControllerTestCase
{
  protected $controller_class = 'MomentCommentsController';

  /**
   * @deprecated
   */
  function testUpdate()
  {
    $this->main_user->save();

    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();

    $this->toolkit->setUser($this->main_user);

    $response = $this->post('update', [
      'text' => $new_comment_text = $this->generator->string(8)
    ], $comment->getId());

    if($this->assertResponse(200))
    {
      $response_comment = $response->result;
      $this->assertJsonMomentComment($response_comment);

      $loaded_comment = MomentComment::findById($comment->getId());
      $this->assertEqual($new_comment_text, $loaded_comment->text);
    }
  }

  function testUpdate_WrongUser()
  {
    $this->main_user->save();

    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('update', [
      'text' => $new_comment_text = $this->generator->string(8)
    ], $comment->getId());

    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
    }
  }

  function testDelete()
  {
    $this->main_user->save();

    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();

    $this->toolkit->setUser($this->main_user);

    $response = $this->post('delete', [], $comment->getId());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $loaded_comment = MomentComment::findById($comment->getId());
      $this->assertFalse($loaded_comment);
    }
  }

  function testDelete_WrongMethod()
  {
    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();

    $this->toolkit->setUser($this->main_user);

    $response = $this->get('delete', [], $comment->getId());
    if($this->assertResponse(405))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], 'Not a POST request');
    }
  }

  function testDelete_WrongUser()
  {
    $this->main_user->save();

    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('delete', [], $comment->getId());
    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Current user don't have permission to perform this action");
    }
  }

  function testDelete_NotFound()
  {
    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('delete', [], $id = $this->generator->integer());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Moment comment with id='{$id}' not found");
    }
  }
}
