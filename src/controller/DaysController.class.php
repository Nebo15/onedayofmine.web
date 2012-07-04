<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class DaysController extends BaseJsonController
{
  protected $_object_class_name = 'User';

  function doItem()
  {
    $id = $this->request->get('id');
    if(false !== strpos($id, ';'))
    {
      $answer = array();
      foreach(explode(';', $id) as $one_id)
        $answer[$one_id] = $this->_item($one_id);
      return $this->_answerOk($answer);
    }
    else
    {
      if($answer = $this->_item($id))
        return $this->_answerOk($answer);
      else
        return $this->_answerNotFound("Day with id='$id' not found");
    }
  }

  function _item($id)
  {
    $day = Day::findById($id);
    if($day && !$day->getIsDeleted())
    {
      $answer = $day->exportForApi();
      $answer->moments = array();
      foreach($day->getMoments() as $moment)
        $answer->moments[] = $moment->exportForApi();
      return $answer;
    }
  }

  function doBegin()
  {
    $day = new Day();

    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    $day->setUser($this->toolkit->getUser());

    $response = $this->_importSaveAndAnswer($day, array('title', 'description', 'time_offset', 'occupation', 'age', 'type'));

//    $this->_getUser()->getFacebookUser()->beginDay($day);

    return $response;
  }

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    return $this->_answerOk();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    return $this->_importSaveAndAnswer($day, array('title', 'description', 'time_offset', 'occupation', 'age', 'type'));
  }

  function doEnd()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    $day->setIsEnded(1);
    $day->save();

    return $this->_answerOk();
  }

  function doDelete()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerOk(404, 'Day not found');

    $day->setIsDeleted(1);
    $day->save();

    return $this->_answerOk();
  }

  function doAddMoment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $errors = $this->_checkPropertiesInRequest(array('id', 'description', 'image_name', 'image_content'));
    if(count($errors))
      return $this->_answerWithError($errors);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound("Day not found by id");

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound("Day not found by id");

    if($day->getIsEnded())
      return $this->_answerWithError("Day is closed");

    $moment = new Moment();
    $moment->setDay($day);
    $moment->setDescription($this->request->get('description'));
    $moment->save();
    $moment->attachImage(
      $this->request->get('image_name'),
      base64_decode($this->request->get('image_content'))
    );
    $moment->save();

    if($this->error_list->isEmpty())
      return $this->_answerOk($moment->exportForApi());
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doComment()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $comment = new DayComment();
    $comment->setText($this->request->get('text'));
    $comment->setDay(Day::findById($this->request->id));
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

  function doShare()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found by id");

    $response = $this->_getUser()->getFacebookUser()->shareDay($day);

    return $this->_answerOk($response);
  }

  function doLike()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found by id");

    $response = $this->_getUser()
                  ->getFacebookUser()
                  ->likeDay($day);

    return $this->_answerOk($response);
  }

  function doFollowingUsers()
  {
  	$from = $this->request->getFiltered('from', FILTER_SANITIZE_NUMBER_INT);
  	$to = $this->request->getFiltered('to', FILTER_SANITIZE_NUMBER_INT);
  	$users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());
		return $this->_answerOk(Day::findByUsersIds($users_ids, $from, $to));
  }

  function doNew()
  {
  	$from = $this->request->getFiltered('from', FILTER_SANITIZE_NUMBER_INT);
  	$to = $this->request->getFiltered('to', FILTER_SANITIZE_NUMBER_INT);
  	return $this->_answerOk(Day::findNew($from, $to));
  }

  function doFavourites()
  {
		return $this->_answerOk($this->_getUser()->getFavouriteDays());
  }
}
