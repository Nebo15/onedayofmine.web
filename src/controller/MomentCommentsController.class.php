<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/MomentComment.class.php');

class MomentCommentsController extends BaseJsonController
{
  function doUserUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment comment', $this->request->id);

    if($comment->user_id != $this->_getUser()->id)
      return $this->_answerNotOwner();

    $comment->text = $this->request->get('text');
    $comment->save();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportMomentComment($comment));
  }

  function doUserDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$comment = MomentComment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment comment', $this->request->id);

    if($comment->user_id != $this->_getUser()->id)
      return $this->_answerNotOwner();

    $this->toolkit->doAsync('momentCommentDelete', $comment->id);

    $comment->destroy();

    return $this->_answerOk();
  }
}
