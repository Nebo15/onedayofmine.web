<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class DaysController extends BaseJsonController
{
  protected $_object_class_name = 'User';
  protected $check_auth = false;

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

  function doCommentCreate()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

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

//    $response = $this->_getUser()->getFacebookUser()->shareDay($day);

    return $this->_answerOk($response);
  }

  function doLike()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found by id");

    $response = $this->_getUser()
                  ->getFacebookUser()
                  ->likeDay($day);

    return $this->_answerOk($response);
  }

  function doUpdate()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFound('Day not found');

  	return $this->_importSaveAndAnswer($day, array('title', 'description', 'timezone', 'location', 'type'));
  }


  function doDelete()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFound('Day not found');

  	$day->setIsDeleted(1);
  	$day->save();

  	return $this->_answerOk();
  }

  function doFollowingUsers()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

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

  function doInteresting()
  {
    $from = $this->request->getFiltered('from', FILTER_SANITIZE_NUMBER_INT);
    $to = $this->request->getFiltered('to', FILTER_SANITIZE_NUMBER_INT);
    return $this->_answerOk(Day::findInteresting($from, $to));
  }

  function doFavourites()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

		return $this->_answerOk($this->_getUser()->getFavouriteDays());
  }

  function doFavourite()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFoound('Day not found');

  	$favourites = $this->_getUser()->getFavouriteDays();
  	$favourites->add($day);
  	$favourites->save();

  	return $this->_answerOk();
  }

  function doUnfavourite()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFoound('Day not found');

  	$favourites = $this->_getUser()->getFavouriteDays();
  	$favourites->remove($day);
  	$favourites->save();

  	return $this->_answerOk();
  }

  function doMy()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	return $this->_answerOk($this->_getUser()->getDays());
  }
}
