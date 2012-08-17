<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/MomentComment.class.php');

class MomentCommentsController extends BaseJsonController
{
  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerWithError("Moment comment not found by id");

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound();

    $comment->setText($this->request->get('text'));
    $comment->save();

    return $this->_answerOk($comment);
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerWithError("Moment comment not found by id");

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound();

    $comment->destroy();

    return $this->_answerOk();
  }
}
