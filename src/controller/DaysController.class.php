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

      // Notify friends about new comment in day
      $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_COMMENT, $comment);

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

    $day_url = $this->toolkit->getSiteUrl('/pages/'.$day->getId().'/day');
    $response = $this->_getUser()->getFacebookUser()->shareDay($day, $day_url);

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

    // TODO FIXME
    // $response = $this->_getUser()
    //               ->getFacebookUser()
    //               ->likeDay($day);

    // Notify friends about day like
    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_LIKE, $day);

    $day->setLikesCount($day->getLikesCount() + 1);
    $day->save();

    return $this->_answerOk('TODO'); //$response
  }

  function doUpdate()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFound('Day not found');

  	return $this->_importSaveAndAnswer($day, array('title', 'occupation', 'timezone', 'location', 'type'));
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

    // Delete corresponding news
    lmbActiveRecord :: delete('News', 'day_id='.$day->getId());

  	return $this->_answerOk();
  }

  function doFollowingUsers()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    list($from, $to) = $this->_getFromToLimitations();
  	$users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());
		return $this->_answerOk(Day::findByUsersIds($users_ids, $from, $to));
  }

  function doNew()
  {
    list($from, $to) = $this->_getFromToLimitations();
  	return $this->_answerOk(Day::findNew($from, $to));
  }

  function doInteresting()
  {
    list($from, $to) = $this->_getFromToLimitations();
    return $this->_answerOk(Day::findInteresting($from, $to));
  }

  function doFavourites()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    list($from, $to) = $this->_getFromToLimitations();
		return $this->_answerOk($this->_getUser()->getFavouriteDaysWithLimitations($from, $to));
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

    list($from, $to) = $this->_getFromToLimitations();

  	return $this->_answerOk($this->_getUser()->getDaysWithLimitations($from, $to, true));
  }

  function doCreateComplaint()
  {
    if(!$this->request->hasPost())
      return $this->_answerNotPost();

    if(!Day::findById($this->request->id))
      return $this->_answerWithError("Day with id '".$this->request->get('day_id')."' not found");

    return $this->_importSaveAndAnswer(new Complaint(), array('day_id', 'text'));
  }

  function doTypeNames() {
    return $this->_answerOk(Day::getTypes());
  }

  protected function _getFromToLimitations()
  {
    return array(
      $this->request->getFiltered('from', FILTER_SANITIZE_NUMBER_INT),
      $this->request->getFiltered('to', FILTER_SANITIZE_NUMBER_INT)
    );
  }
}
