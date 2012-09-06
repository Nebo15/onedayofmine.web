<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Moment.class.php');

class MomentsController extends BaseJsonController
{
  protected $_object_class_name = 'Moment';

  function doUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if($moment->getDay()->getUser()->getId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    if($this->request->has('image_content'))
      $moment->attachImage(base64_decode($this->request->get('image_content')));

    if($this->request->get('time'))
    {
      list($stamp, $zone) = Moment::isoToStamp($this->request->get('time'));
      $moment->setTime($stamp);
      $moment->setTimezone($zone);
    }

    if($this->request->get('description'))
      $moment->setDescription($this->request->get('description'));

    if($this->error_list->isEmpty())
    {
      $moment->saveSkipValidation();
      return $this->_answerOk($this->toolkit->getExportHelper()->exportMoment($moment));
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doComment()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    $comment = new MomentComment();
    $comment->setText($this->request->get('text'));
    $comment->setMoment($moment);
    $comment->setUser($this->toolkit->getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();

      $this->toolkit->getNewsObserver()->onComment($comment);

      return $this->_answerOk($this->toolkit->getExportHelper()->exportMomentComment($comment));
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if($moment->getDay()->getUser()->getId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $moment->setIsDeleted(1);
    $moment->save();

    $this->toolkit->getNewsObserver()->onMomentDelete($moment);

    return $this->_answerOk();
  }

  function doRestore()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if($moment->getDay()->getUser()->getId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $moment->setIsDeleted(0);
    $moment->save();

    // $this->toolkit->getNewsObserver()->onMomentRestore($moment);

    return $this->_answerOk();
  }

  function doLike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    $like = new MomentLike;
    $like->setMoment($moment);
    $like->setUser($this->_getUser());
    $like->save();

    $this->toolkit->getPostingService()->shareMomentLike($moment, $like);
    $this->toolkit->getNewsObserver()->onLike($moment);

    return $this->_answerOk();
  }

  function doUnlike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if(!$like = MomentLike::findByMomentIdAndUserId($moment->getId(), $this->_getUser()->getId()))
      return $this->_answerOk("Like not found");

    $this->toolkit->getPostingService()->shareMomentUnlike($moment, $like);
    // $this->toolkit->getNewsObserver()->onLikeDelete($moment);

    $like->destroy();

    return $this->_answerOk();
  }

  function doGuestComments()
  {
    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    list($from, $to, $limit) = $this->_getFromToLimitations();

    $answer = array();
    foreach ($moment->getCommentsWithLimitation($from, $to, $limit) as $comment)
    {
      $export = $comment->exportForApi();
      $export->user = $comment->getUser()->exportForApi();
      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }
}
