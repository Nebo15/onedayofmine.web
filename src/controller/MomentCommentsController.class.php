<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/MomentComment.class.php');

class MomentCommentsController extends BaseJsonController
{
  function doUserUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment comment', $this->request->id);

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $comment->setText($this->request->get('text'));
    $comment->save();

    return $this->_answerOk($comment);
  }

  function doUserDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment comment', $this->request->id);

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $comment->destroy();

    return $this->_answerOk();
  }
}
