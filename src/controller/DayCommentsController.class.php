<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayComment.class.php');

class DayCommentsController extends BaseJsonController
{
  function doUserDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $comment = DayComment::findById($this->request->id);
    if(!$comment || $comment->getUser()->id != $this->toolkit->getUser()->id)
      return $this->_answerNotFound("Day comment with id '".$this->request->get('id')."' not found");

    $comment->destroy();
    return $this->_answerOk();
  }
}
