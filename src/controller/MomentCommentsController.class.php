<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/MomentComment.class.php');

class MomentCommentsController extends BaseJsonController
{
  function doUserUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost('Not a POST request');

    $comment = MomentComment::findById($this->request->id);
    if(!$comment || $comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound("Moment comment with id ".$this->request->get('id')." not found");

    $comment->setText($this->request->get('text'));
    $comment->save();

    return $this->_answerOk($comment);
  }

  function doUserDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost('Not a POST request');

    $comment = MomentComment::findById($this->request->id);
    if(!$comment || $comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound("Moment comment with id ".$this->request->get('id')." not found");

    $comment->destroy();

    return $this->_answerOk();
  }
}
