<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DayCommentsContoller.class.php');
lmb_require('src/model/Day.class.php');

class DayCommentsControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DayCommentsController';

  function testDelete()
  {
    $user = $this->generator->user();
    $user->save();
    $day = $this->generator->day();
    $comment = $this->generator->dayComment($day, $user);
    $comment->save();

    $comments = DayComment::find();
    $this->assertEqual(1, $comments->count());

    lmbToolkit::instance()->setUser($user);
    $this->post('delete', [], $comment->getId());

    if($this->assertResponse(200))
    {
      $comments = DayComment::find();
      $this->assertEqual(0, $comments->count());
    }
  }

  function testDelete_WrongMethod()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($comment->getUser());

    $response = $this->get('delete', [], $comment->id);
    if($this->assertResponse(405))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], 'Not a POST request');
    }
  }

  function testDelete_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $comments = DayComment::find();
    $this->assertEqual(0, $comments->count());

    $response = $this->post('delete', [], $id = $this->generator->integer());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Day comment with id='{$id}' not found");
    }
  }

  function testDelete_WrongUser()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $comment->id);
    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Current user don't have permission to perform this action");
    }
  }
}
