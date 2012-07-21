<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Moment.class.php');

class MomentsController extends BaseJsonController
{
  protected $_object_class_name = 'Moment';

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerWithError("Moment not found by id");

    return $this->_importSaveAndAnswer($moment, array('description'));
  }

  function doComment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $comment = new MomentComment();
    $comment->setText($this->request->get('text'));
    $comment->setMoment(Moment::findById($this->request->id));
    $comment->setUser($this->toolkit->getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();

      // Notify friends about new comment in moment
      $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_COMMENT, $comment);

      return $this->_answerOk($comment->exportForApi());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerWithError("Moment not found by id");

    if($moment->getDay()->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError("Moment not found by id");

    $moment->destroy();

    // Delete corresponding news
    lmbActiveRecord :: delete('News', 'moment_id='.$moment->getId());

    return $this->_answerOk();
  }

  //POST /moments/<momentId>/comments/<commentId>/update
}
