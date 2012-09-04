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

  function doLike()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$comment = DayComment::findById($this->request->id))
      return $this->_answerNotFound("Day comment not found by id");

    if($this->_getUser()->getId() == $comment->getUser()->getId())
      return $this->_answerWithError("You can't like you'r own comments");

    $like = new DayCommentLike;
    $like->setDayComment($comment);
    $like->setUser($this->_getUser());
    $like->save();

    return $this->_answerOk();
  }

  function doUnlike()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$comment = DayComment::findById($this->request->id))
      return $this->_answerNotFound("Day comment not found by id");

    if(!$like = DayCommentLike::findByDayCommentIdAndUserId($comment->getId(), $this->_getUser()->getId()))
      return $this->_answerOk("Like not found");

    $this->toolkit->getPostingService()->shareDayUnlike($day);
    // $this->toolkit->getNewsObserver()->onLikeDelete($day);

    $like->destroy();

    return $this->_answerOk();
  }
}
