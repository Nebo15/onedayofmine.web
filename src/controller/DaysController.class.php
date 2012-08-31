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
        return $this->_answerNotFound("Day with id='{$id}' not found");
    }
  }

  function _item($id)
  {
    $day = Day::findById($id);
    if($day && !$day->getIsDeleted())
      return $this->_exportFullDay($day);
  }

  function doStart()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    $errors = $this->_checkPropertiesInRequest(array('title', 'type'));
    if(count($errors))
      return $this->_answerWithError($errors);

    $day = new Day();
    $day->setUser($this->_getUser());
    // Required
    $day->setTitle($this->request->getPost('title'));
    $day->setType($this->request->getPost('type'));
    // Optional
    $day->setLocation($this->request->getPost('location') ?: $this->_getUser()->getLocation());
    $day->setOccupation($this->request->getPost('occupation') ?: $this->_getUser()->getOccupation());
    $day->save();

    $user = $this->_getUser();
    $user->setCurrentDay($day);
    $user->save();

    $day->getDefaultConnection()->commitTransaction();

    $this->toolkit->getNewsObserver()->onDay($day);

    try
    {
      $this->toolkit->getPostingService()->shareDayBegin($day);
    }
    catch(odFacebookApiExpiredTokenException $e)
    {
      $day->destroy();
      return $this->_answerUnauthorized('Token expired');
    }

    return $this->_answerOk($this->_exportFullDay($day));
  }

  function doUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    if($this->_getUser()->getId() != $day->getUser()->getId())
      return $this->_answerWithError('You can update only your own days', null, 401);

    if($this->request->get('cover_content')) {
      $day->attachImage(base64_decode($this->request->get('cover_content')));
      $day->save();
    }

    $this->_importSaveAndAnswer($day, array('title', 'occupation', 'location', 'type'));

    return $this->_answerOk($this->_exportFullDay($day));
  }

  function doCurrent()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$day = $this->_getUser()->getCurrentDay())
      return $this->_answerNotFound('Current day not set');

    return $this->_answerOk($this->_exportFullDay($day));
  }

  function doFinish()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound("Day not found");

    $user = $this->_getUser();
    if($current_day = $user->getCurrentDay()) {
      if($day->getId() == $current_day->getId()) {
        $user->setCurrentDay(null);
        $user->save();
      }
    }

    if($this->request->get('image_content')){
      $day->attachImage(base64_decode($this->request->get('image_content')));
      $day->save();
    }

    if($this->request->get('comment')) {
      $comment = new DayFinishComment();
      $comment->setDay($day);
      $comment->setText($this->request->get('comment'));
      $comment->setUser($this->_getUser());
      $comment->save();
    }

    return $this->_answerOk($this->_exportFullDay($day));
  }

  function doMarkCurrent()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request', null, 405);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    $user = $this->_getUser();
    $user->setCurrentDay($day);
    $user->save();

    return $this->_answerOk();
  }

  function doShare()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found");

    $this->toolkit->getPostingService()->shareDay($day);

    return $this->_answerOk();
  }

  function doLike()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found");

    if($this->_getUser()->getId() == $day->getUserId())
      return $this->_answerWithError("You can't like you'r own days");

    $like = new DayLike;
    $like->setDay($day);
    $like->setUser($this->_getUser());
    $like->save();

    $this->toolkit->getPostingService()->shareDayLike($day);
    $this->toolkit->getNewsObserver()->onLike($day);

    return $this->_answerOk();
  }

  function doUnlike()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerWithError("Day not found");

    DayLike::deleteUserLikeInDay($this->_getUser(), $day);

    // $this->toolkit->getPostingService()->shareDayLikeDelete($day);
    // $this->toolkit->getNewsObserver()->onLikeDelete($day);

    return $this->_answerOk();
  }

  function doDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError('You can delete only your own days', null, 401);

    $day->setIsDeleted(1);
    $day->save();

    $this->toolkit->getNewsObserver()->onDayDelete($day);

    return $this->_answerOk();
  }

  function doRestore()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerWithError('You can restore only your own days', null, 401);

    $day->setIsDeleted(0);
    $day->save();

    return $this->_answerOk();
  }

  function doFollowing()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());

    $days = Day::findByUsersIds($users_ids, $from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $answer[] = $this->_exportDayWithSubentities($day);
    }
    return $this->_answerOk($answer);
  }

  function doGuestNew()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = Day::findNew($from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $answer[] = $this->_exportDayWithSubentities($day);
    }

    return $this->_answerOk($answer);
  }

  function doGuestInteresting()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days_ratings = (new InterestCalculator())->getDaysRatings($from, $to, $limit);

    $answer = array();
    foreach ($days_ratings as $day_rating) {
      $answer[] = $this->_exportDayWithSubentities($day_rating->getDay());
    }

    return $this->_answerOk($answer);
  }

  function doFavourite()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getFavouriteDaysWithLimitations($from, $to, $limit);

    $answer = array();
    foreach ($days as $day) {
      $answer[] = $this->_exportDayWithSubentities($day);
    }

    return $this->_answerOk($answer);
  }

  function doMarkFavourite()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    $favourites = $this->_getUser()->getFavouriteDays();
    $favourites->add($day);
    $favourites->save();

    return $this->_answerOk();
  }

  function doUnmarkFavourite()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

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
      $export = $this->_exportDayWithSubentities($day);
      $this->_attachDayIsDeleted($export, $day);
      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doAddMoment()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    $errors = $this->_checkPropertiesInRequest(array('description', 'image_content'));
    if(count($errors))
      return $this->_answerWithError($errors);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerNotFound('Day not found');

    $image_content = base64_decode($this->request->get('image_content'));
    if(!count($day->getMoments()))
    {
      $day->attachImage($image_content);
      $day->save();
    }

    $moment = new Moment();
    $moment->setDay($day);
    $moment->setDescription($this->request->get('description'));
    $moment->save();

    $moment->attachImage($image_content);
    $moment->save();

    if($this->request->get('time')) {
      list($time, $timezone) = Moment::isoToStamp($this->request->get('time'));
      $moment->setTime($time);
      $moment->setTimezone($timezone);
    }
    else
    {
      $moment->setTimezone($this->toolkit->getUser()->getTimezone());
    }
    $moment->save();

    if($this->error_list->isEmpty())
    {
      $this->toolkit->getNewsObserver()->onMoment($moment);

      $answer = $moment->exportForApi();
      $answer->likes_count = $moment->getLikes()->count();
      return $this->_answerOk($answer);
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doCommentCreate()
  {
    if(!$this->request->isPost())
      return $this->_answerWithError('Not a POST request');

    $comment = new DayComment();
    $comment->setText($this->request->get('text'));
    $comment->setDay(Day::findById($this->request->id));
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

  function doCreateComplaint()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!Day::findById($this->request->id))
      return $this->_answerWithError("Day with id '".$this->request->get('day_id')."' not found");

    return $this->_importSaveAndAnswer(new Complaint(), array('day_id', 'text'));
  }

  function doGuestTypes()
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
      $answer[] = $this->_exportDayWithSubentities($day);
    }

    return $this->_answerOk($answer);
  }
}
