<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Moment.class.php');

class MomentController extends BaseJsonController
{
  protected $_object_class_name = 'Moment';

  function doUpdate()
  {
    return $this->_answerOk(odMock::moment());
  }

  function doShare()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$moment = Moment::findById($this->request->get('moment_id')))
      return $this->_answerWithError("Moment not found by id");

    $message = $moment->getDescription();
    $img_url = lmb_env_get('HOST_NAME').$moment->getImageUrl();
    $link = $this->toolkit->getSiteUrl('/day/item/'.$moment->getDay()->getId().'#'.$moment->getId());
    $response = $this->_getUser()->getFacebookUser()->postOnWall($message, $img_url, $link);

    $response['data'] = array($message, $img_url, $link);

    return $this->_answerOk($response);
  }

  function doComment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $comment = new MomentComment();
    $comment->setText($this->request->get('text'));
    $comment->setMoment(Moment::findById($this->request->get('moment_id')));
    $comment->setUser($this->toolkit->getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();
      return $this->_answerOk($comment->exportForApi());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doDelete()
  {
    return $this->_answerOk();
  }
}
