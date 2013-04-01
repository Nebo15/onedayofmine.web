<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/DayComment.class.php');

class DayCommentsController extends BaseJsonController
{
  function doUserDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$comment = DayComment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day comment', $this->request->id);

    if($comment->user_id != $this->toolkit->getUser()->id)
      return $this->_answerNotOwner();

    $this->toolkit->doAsync('dayCommentDelete', $comment->id);

    $comment->destroy();

    return $this->_answerOk();
  }
}
