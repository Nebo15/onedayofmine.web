<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayComment.class.php');

class DayCommentsController extends BaseJsonController
{
  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$comment = DayComment::findById($this->request->id))
      return $this->_answerNotFound("Day comment not found by id");

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError("You can update only you'r own comments.", null, 401);

    $comment->setText($this->request->get('text'));
    $comment->save();

    $answer = $this->_exportWithLikes($comment);

    return $this->_answerOk($answer);
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$comment = DayComment::findById($this->request->id))
      return $this->_answerNotFound("Day comment not found by id");

    if($comment->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError("You can update only you'r own comments.", null, 401);

    $this->toolkit->getNewsObserver()->onCommentDelete($comment);

    $comment->destroy();

    return $this->_answerOk();
  }
}
