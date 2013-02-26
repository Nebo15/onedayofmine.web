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

    $day = Day::findById($moment->day_id);
    if($day->user_id != $this->_getUser()->id)
      return $this->_answerNotOwner();

    if($this->request->has('image_content'))
      $moment->attachImage(base64_decode($this->request->get('image_content')));

    if($this->request->get('time'))
    {
      list($stamp, $zone) = Moment::isoToStamp($this->request->get('time'));
      $moment->time = $stamp;
      $moment->timezone = $zone;
    }

    if($this->request->get('description'))
      $moment->description = $this->request->get('description');

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
    $comment->text = $this->request->get('text');
    $comment->setMoment($moment);
    $comment->setUser($this->toolkit->getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();
      $this->toolkit->doAsync('momentCommentCreate', $comment->id);
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
      return $this->_answerOk(null, 'Already deleted');

    $day = Day::findById($moment->day_id);
    if($day->user_id != $this->_getUser()->id)
      return $this->_answerNotOwner();

    $moment->is_deleted = 1;
    $moment->save();

    $this->toolkit->doAsync('momentDelete', $moment->id);

    return $this->_answerOk();
  }

  function doRestore()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    $day = Day::findById($moment->day_id);
    if($day->user_id != $this->_getUser()->id)
      return $this->_answerNotOwner();

    $moment->is_deleted = 0;
    $moment->save();

    $this->toolkit->doAsync('momentRestore', $moment->id);

    return $this->_answerOk();
  }

  function doLike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if(MomentLike::findByMomentIdAndUserId($moment->id, $this->_getUser()->id))
      return $this->_answerConflict();

    $like = new MomentLike;
    $like->setMoment($moment);
    $like->setUser($this->_getUser());
    $like->save();

    $this->toolkit->doAsync('momentLike', $moment->id, $like->id);

    return $this->_answerOk();
  }

  function doUnlike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    if(!$like = MomentLike::findByMomentIdAndUserId($moment->id, $this->_getUser()->id))
      return $this->_answerOk(null, "Like not found");

    $this->toolkit->doAsync('momentUnlike', $moment->id, $like->id);

    $like->destroy();

    return $this->_answerOk();
  }

  function doGuestComments()
  {
    if(!$moment = Moment::findById($this->request->id))
      return $this->_answerModelNotFoundById('Moment', $this->request->id);

    list($from, $to, $limit) = $this->_getFromToLimitations();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportMomentCommentItems($moment->getCommentsWithLimitation($from, $to, $limit)));
  }

	function doApprove()
	{
		if(!$this->request->isPost())
			return $this->_answerNotPost();

		if(!$moment = Moment::findById($this->request->id))
			return $this->_answerModelNotFoundById('Moment', $this->request->id);

		$day = Day::findById($moment->day_id);
		if($day->user_id != $this->_getUser()->id)
			return $this->_answerNotOwner();

		$moment->is_hidden = 0;
		$moment->save();

		return $this->_answerOk();
	}
}
