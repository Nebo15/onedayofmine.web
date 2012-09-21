<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DayCommentsContoller.class.php');

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

    $this->assertResponse(200);
    $comments = DayComment::find();
    $this->assertEqual(0, $comments->count());
  }

  function testDelete_WrongMethod()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($comment->getUser());

    $this->get('delete', [], $comment->id);
    $this->assertResponse(405);
  }

  function testDelete_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $comments = DayComment::find();
    $this->assertEqual(0, $comments->count());

    $this->post('delete', [], $this->generator->integer());
    $this->assertResponse(404);
  }

  function testDelete_WrongUser()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('delete', [], $comment->id);
    $this->assertResponse(401);
  }
}
