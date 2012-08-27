<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Moment.class.php');

class MomentsController extends BaseJsonController
{
  protected $_object_class_name = 'Moment';

  function doUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerWithError("Moment not found by id");

    if($this->request->has('image_content'))
      $moment->attachImage(base64_decode($this->request->get('image_content')));

    return $this->_importSaveAndAnswer($moment, array('description'));
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
      return $this->_answerWithError('Not a POST request');

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerWithError("Moment not found by id");

    if($moment->getDay()->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError("Moment not found by id");

    $moment->destroy();

    $this->toolkit->getNewsObserver()->onMomentDelete($moment);

    return $this->_answerOk();
  }
}
