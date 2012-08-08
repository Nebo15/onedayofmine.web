<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class DaysController extends BaseJsonController
{
  protected $_object_class_name = 'User';

  function doGuestItem()
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

      // User data
      $this->_attachDayUser($answer, $day);

      // Favorites data
      $this->_attachDayIsFavorited($answer, $day);

      // Comments data
      $this->_attachComments($answer, $day);

      // Moments data
      $this->_attachDayMoments($answer, $day);

      return $answer;
    }
  }

  function doStart()
  {
    $day = new Day();
    $day->setIsEnded(0);

    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    $day->setUser($this->_getUser());
    $occupation = $this->request->getPost('occupation') ?: $this->_getUser()->getOccupation();
    $day->setOccupation($occupation);

    $response = $this->_importSaveAndAnswer($day, array('title', 'timezone', 'location', 'type'), array('occupation' => $occupation));

    $this->_getUser()
      ->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)
      ->shareDayBegin($day, $this->toolkit->getSiteUrl('/pages/'.$day->getId().'/day'));

    // Notify friends about new day
    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_DAY, $day);

    return $response;
  }

  function doFinish()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findUnfinished($this->_getUser()))
      return $this->_answerNotFound('Unfinished day not found');

    $day->setIsEnded(1);
    $day->save();

    return $this->_answerOk();
  }

  function doMomentCreate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $errors = $this->_checkPropertiesInRequest(array('description', 'time', 'img_content'));
    if(count($errors))
      return $this->_answerWithError($errors);

    if(!$day = Day::findUnfinished($this->_getUser()))
      return $this->_answerNotFound('Unfinished day not found');

    if(!count($day->getMoments()))
    {
      $day->attachImage(base64_decode($this->request->get('img_content')));
    }

    $moment = new Moment();
    $moment->setDay($day);
    $moment->setDescription($this->request->get('description'));

    list($time, $timezone) = Moment::isoToStamp($this->request->get('time'));
    $moment->setTime($time);
    $moment->setTimezone($timezone);

    $moment->save();
    $moment->attachImage(base64_decode($this->request->get('img_content')));
    $moment->save();

    if($this->error_list->isEmpty()) {
      // Notify friends about new moment
      $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_MOMENT, $moment);

      return $this->_answerOk($moment->exportForApi());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doCommentCreate()
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
    $response = $this->_getUser()->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->shareDay($day, $day_url);

    return $this->_answerOk($response);
  }

  function doLike()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found by id");

    // TODO FIXME
    // $response = $this->_getUser()
    //               ->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)
    //               ->likeDay($day);

    // Notify friends about day like
    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_LIKE, $day);

    $day->setLikesCount($day->getLikesCount() + 1);
    $day->save();

    return $this->_answerOk('TODO'); //$response
  }

  function doUpdate()
  {
  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFound('Day not found');

    if($this->_getUser()->getId() != $day->getUserId())
      return $this->_answerNotFound('Day not found');

    if($this->request->get('cover_content'))
      $day->attachImage(base64_decode($this->request->get('cover_content')));

  	return $this->_importSaveAndAnswer($day, array('title', 'occupation', 'location', 'type'));
  }


  function doDelete()
  {
  	if(!$this->request->hasPost())
  		return $this->_answerWithError('Not a POST request');

  	if(!$day = Day::findById($this->request->id))
  		return $this->_answerNotFound('Day not found');

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound('Day not found');

  	$day->setIsDeleted(1);
  	$day->save();

    // Delete corresponding news
    lmbActiveRecord :: delete('News', 'day_id='.$day->getId());

  	return $this->_answerOk();
  }

  function doRestore()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotFound('Day not found');

    $day->setIsDeleted(0);
    $day->save();

    return $this->_answerOk();
  }

  function doFollowingUsers()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
  	$users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());

    $days = Day::findByUsersIds($users_ids, $from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $export = $day->exportForApi();

      // User data
      $this->_attachDayUser($export, $day);

      // Favorites data
      $this->_attachDayIsFavorited($export, $day);

      $answer[] = $export;
    }
		return $this->_answerOk($days);
  }

  function doGuestNew()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = Day::findNew($from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $export = $day->exportForApi();

      // User data
      $this->_attachDayUser($export, $day);

      // Favorites data
      $this->_attachDayIsFavorited($export, $day);

      $answer[] = $export;
    }

  	return $this->_answerOk($answer);
  }

  function doGuestInteresting()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days_ratings = (new InterestCalculator())->getDaysRatings($from, $to, $limit);

    $answer = array();
    foreach ($days_ratings as $day_rating) {
      $export = $day_rating->getDay()->exportForApi();

      // User data
      $this->_attachDayUser($export, $day_rating->getDay());

      // Favorites data
      $this->_attachDayIsFavorited($export, $day_rating->getDay());

      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doFavourites()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getFavouriteDaysWithLimitations($from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $export = $day->exportForApi();

      // User data
      $this->_attachDayUser($export, $day);

      // Favorites data
      $this->_attachDayIsFavorited($export, $day);

      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doFavourite()
  {
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
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getDaysWithLimitations($from, $to, $limit, true);

    $answer = array();
    foreach ($days as $day) {
      $export = $day->exportForApi();
      $this->_attachDayUser($export, $day);
      $this->_attachDayIsFavorited($export, $day);
      $this->_attachDayIsDeleted($export, $day);
      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doCreateComplaint()
  {
    if(!$this->request->hasPost())
      return $this->_answerNotPost();

    if(!Day::findById($this->request->id))
      return $this->_answerWithError("Day with id '".$this->request->get('day_id')."' not found");

    return $this->_importSaveAndAnswer(new Complaint(), array('day_id', 'text'));
  }

  function doGuestTypeNames()
  {
    return $this->_answerOk(Day::getTypes());
  }

  function doGuestSearch()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $query = $this->request->getFiltered('query', FILTER_SANITIZE_STRING);
    $days = Day::findByString($query, $from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $export = $day->exportForApi();

      // User data
      $this->_attachDayUser($export, $day);

      // Favorites data
      $this->_attachDayIsFavorited($export, $day);

      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  protected function _attachDayUser(stdClass $day_export, $day)
  {
    $day_export->user = $day->getUser()->exportForApi();
    unset($day_export->user_id);

    // if(lmbToolkit::instance()->getUser() && $day->getUser()->getId() != lmbToolkit::instance()->getUser()->getId()) {
    //   $day_export->user->is_followed = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $day->getUser());
    //   $day_export->user->is_follower = UserFollowing::isFollowing($day->getUser(), lmbToolkit::instance()->getUser());
    // }
  }

  protected function _attachDayIsFavorited(stdClass $day_export, $day)
  {
    if(!lmbToolkit::instance()->getUser())
      return null;
    $day_export->is_favorite = DayFavourite::isFavourited(lmbToolkit::instance()->getUser(), $day);
  }

  protected function _attachDayIsDeleted(stdClass $day_export, $day)
  {
    if(!lmbToolkit::instance()->getUser())
      return null;
    if(lmbToolkit::instance()->getUser()->getId() != $day->getUserId())
      return null;
    $day_export->is_deleted = $day->getIsDeleted();
  }

  protected function _attachComments(stdClass $export, $obj, $only_count = false)
  {
    $comments = $obj->getComments();
    $export->comments_count = $comments->count();

    if($only_count)
      return;

    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    $export->comments = array();
    foreach ($comments as $comment) {
      $tmp = $comment->exportForApi();
      $tmp->user = $comment->getUser()->exportForApi();
      unset($tmp->day_id);
      unset($tmp->user_id);
      $export->comments[] = $tmp;
    }
  }

  protected function _attachDayMoments(stdClass $day_export, $day)
  {
    $day_export->moments = array();
    foreach($day->getMoments() as $moment) {
      $moment_export = $moment->exportForApi();

      // Moment day data
      unset($moment_export->day_id);

      // Moment comments data
      //$this->_attachComments($moment_export, $moment);

      $day_export->moments[] = $moment_export;
    }
  }
}
