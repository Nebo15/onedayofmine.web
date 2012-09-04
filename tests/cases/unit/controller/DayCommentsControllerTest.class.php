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
    $comment = $this->generator->dayComment(null, $user);
    $comment->save();

    lmbToolkit::instance()->setUser($user);
    $this->post('delete', array(), $comment->getId());

    $this->assertResponse(200);
    $this->assertFalse(DayComment::findById($comment->id));
  }

  function testDelete_WrongMethod()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($comment->getUser());

    $this->get('delete', array(), $comment->id);
    $this->assertResponse(405);
  }

  function testDelete_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('delete', array(), 100500);
    $this->assertResponse(404);
  }

  function testDelete_WrongUser()
  {
    $comment = $this->generator->dayComment();
    $comment->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('delete', array(), $comment->id);
    $this->assertResponse(404);
  }
}
