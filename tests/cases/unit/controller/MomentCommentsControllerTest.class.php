<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MomentCommentsController.class.php');

class MomentCommentsControllerTest extends odControllerTestCase
{
  protected $controller_class = 'MomentCommentsController';

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
    $this->main_user->save();
    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();
    $new_comment_text = $this->generator->string(8);

    $this->_loginAndSetCookie($this->main_user);
    $this->post('update', array('text' => $new_comment_text), $comment->getId());
    $this->assertResponse(200);

    $loaded_comment = MomentComment::findById($comment->getId());
    $this->assertEqual($new_comment_text, $loaded_comment->text);
  }

  function testUpdate_WrongUser()
  {
    $this->main_user->save();
    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();
    $new_comment_text = $this->generator->string(8);

    $this->_loginAndSetCookie($this->additional_user);
    $this->post('update', array('text' => $new_comment_text), $comment->getId());
    $this->assertResponse(404);
  }

  /**
   * @api
   */
  function testDelete()
  {
    $this->main_user->save();
    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();
    $new_comment_text = $this->generator->string(8);

    $this->_loginAndSetCookie($this->main_user);
    $this->post('delete', array('text' => $new_comment_text), $comment->getId());
    $this->assertResponse(200);

    $loaded_comment = MomentComment::findById($comment->getId());
    $this->assertFalse($loaded_comment);
  }

  function testDelete_WrongUser()
  {
    $this->main_user->save();
    $comment = $this->generator->momentComment(null, $this->main_user);
    $comment->save();
    $new_comment_text = $this->generator->string(8);

    $this->_loginAndSetCookie($this->additional_user);
    $this->post('delete', array('text' => $new_comment_text), $comment->getId());
    $this->assertResponse(404);
  }
}
