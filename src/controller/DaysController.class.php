<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Complaint.class.php');
lmb_require('src/model/DayFavorite.class.php');

class DaysController extends BaseJsonController
{
  function doGuestItem()
  {
    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if($day->getIsDeleted())
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $day->views_count = $day->views_count + 1;
    $day->save();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
  }

  function doStart()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $errors = $this->_checkPropertiesInRequest(array('title', 'type'));
    if(count($errors))
      return $this->_answerWithError($errors);

    $day = new Day();
    $day->setUser($this->_getUser());
    $day->setTitle($this->request->getPost('title'));
    $day->setType($this->request->getPost('type'));
    $day->save();

    $user = $this->_getUser();
    $user->setCurrentDay($day);
    $user->save();

    $day->getDefaultConnection()->commitTransaction();

    $this->toolkit->doAsync('shareDayStart', $day->id);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
  }

  function doUpdate()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if($this->_getUser()->getId() != $day->getUser()->getId())
      return $this->_answerNotOwner();

    if($this->request->get('cover_content')) {
      $day->attachImage(base64_decode($this->request->get('cover_content')));
      $day->save();
    }

    $this->_importSaveAndAnswer($day, array('title', 'occupation', 'location', 'type'));

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
  }

  function doCurrent()
  {
    if(!$day = $this->_getUser()->getCurrentDay())
      return $this->_answerNotFound('Current day not set');

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
  }

  function doFinish()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $user = $this->_getUser();
    if($day->getUser()->getId() != $user->getId())
      return $this->_answerNotOwner();

    if($current_day = $user->getCurrentDay()) {
      if($day->getId() == $current_day->getId()) {
        $user->setCurrentDay(null);
        $user->save();
      }
    }

    if($this->request->get('image_content')) {
      $day->attachImage(base64_decode($this->request->get('image_content')));
      $day->save();
    }

    if($this->request->get('final_description')) {
      $day->setFinalDescription($this->request->get('final_description'));
      $day->save();
    }

    $this->toolkit->doAsync('shareDayEnd', $day->id);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
  }

  function doMarkCurrent()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $user = $this->_getUser();
    $user->setCurrentDay($day);
    $user->save();

    return $this->_answerOk();
  }

  function doShare()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $this->toolkit->doAsync('shareDay', $day->id);

    return $this->_answerOk();
  }

  function doLike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(DayLike::findByDayIdAndUserId($day->getId(), $this->_getUser()->getId()))
      return $this->_answerConflict();

    $like = new DayLike;
    $like->setDay($day);
    $like->setUser($this->_getUser());
    $like->save();

    $this->toolkit->doAsync('dayLike', $day->id, $like->id);

    return $this->_answerOk();
  }

  function doUnlike()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(!$like = DayLike::findByDayIdAndUserId($day->getId(), $this->_getUser()->getId()))
      return $this->_answerOk(null, "Like not found");

    $this->toolkit->doAsync('dayUnlike', $day->id, $like->id);

    $like->destroy();

    return $this->_answerOk();
  }

  function doDelete()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $day->setIsDeleted(1);
    $day->save();

    $this->toolkit->doAsync('dayDelete', $day->id);

    return $this->_answerOk();
  }

  function doRestore()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if($day->getUserId() != $this->_getUser()->getId())
      return $this->_answerNotOwner();

    $day->setIsDeleted(0);
    $day->save();

    $this->toolkit->doAsync('dayRestore', $day->id);

    return $this->_answerOk();
  }

  function doFollowing()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());

    if(!count($users_ids))
      return $this->_answerOk([]);

    $days = Day::findByUsersIds($users_ids, $from, $to, $limit);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doGuestNew()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = Day::findNew($from, $to, $limit);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doGuestInteresting()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days_ratings = (new InterestCalculator())->getDaysRatings($from, $to, $limit);

    $days = [];
    foreach($days_ratings as $day_rating)
      $days[] = $day_rating->getDay();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doFavorite()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getFavoriteDaysWithLimitations($from, $to, $limit);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doMarkFavorite()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(DayFavorite::isFavorited($this->_getUser(), $day))
      return $this->_answerConflict();

    $favorites = $this->_getUser()->getFavoriteDays();
    $favorites->add($day);
    $favorites->save();

    return $this->_answerOk();
  }

  function doUnmarkFavorite()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(!DayFavorite::findByDayIdAndUserId($day->getId(), $this->_getUser()->getId()))
      return $this->_answerOk(null, "Favorite not found");

    $favorites = $this->_getUser()->getFavoriteDays();
    $favorites->remove($day);
    $favorites->save();

    return $this->_answerOk();
  }

  function doMy()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getDaysWithLimitations($from, $to, $limit, true);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doAddMoment()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $errors = $this->_checkPropertiesInRequest(array('description', 'image_content'));
    if(count($errors))
      return $this->_answerWithError($errors);

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

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

    if($this->request->get('time'))
    {
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
      $this->toolkit->doAsync('momentCreate', $moment->id);
      return $this->_answerOk($this->toolkit->getExportHelper()->exportMoment($moment));
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doComment()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $comment = new DayComment();
    $comment->setText($this->request->get('text'));
    $comment->setDay($day);
    $comment->setUser($this->_getUser());
    $comment->validate($this->error_list);

    if($this->error_list->isEmpty())
    {
      $comment->saveSkipValidation();
      $this->toolkit->doAsync('dayCommentCreate', $comment->id);
      return $this->_answerOk($this->toolkit->getExportHelper()->exportDayComment($comment));
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doComplain()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    $complaint = new Complaint();
    $complaint->setDay($day);
    $complaint->setText($this->request->get('text'));

    $complaint->validate($this->error_list);
    if($this->error_list->isValid())
    {
      $complaint->saveSkipValidation();
      return $this->_answerOk($this->toolkit->getExportHelper()->exportComplaint($complaint));
    }
    else
    {
      return $this->_answerWithError($this->error_list->getReadable());
    }
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

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doGuestComments()
  {
    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    list($from, $to, $limit) = $this->_getFromToLimitations();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayCommentItems($day->getCommentsWithLimitation($from, $to, $limit)));
  }
}
