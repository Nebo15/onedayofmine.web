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

    $moment = Moment::findById($this->request->id);
    if(!$moment || $moment->getDay()->getUser()->id != $this->_getUser()->id)
      return $this->_answerNotFound("Moment with id=".$this->request->id." not found");

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
      return $this->_answerOk($moment->exportForApi());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doComment()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    $comment = new MomentComment();
    $comment->setText($this->request->get('text'));
    $comment->setMoment(Moment::findById($this->request->id));
    $comment->setUser($this->toolkit->getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();

      $this->toolkit->getNewsObserver()->onComment($comment);

      return $this->_answerOk($comment->exportForApi());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $moment = Moment::findById($this->request->id);
    if(!$moment || $moment->getDay()->getUser()->id != $this->_getUser()->id)
      return $this->_answerNotFound("Moment not found by id ".$this->request->id);

    $moment->destroy();

    $this->toolkit->getNewsObserver()->onMomentDelete($moment);

    return $this->_answerOk();
  }

  function doGuestComments()
  {
    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerNotFound("Moment with id '".$this->request->get('id')."' not found");

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
