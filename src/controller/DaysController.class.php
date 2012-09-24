<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class DaysController extends BaseJsonController
{
  protected $_object_class_name = 'User';

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
    catch(FacebookApiException $e)
    {
      lmbToolkit::instance()->getLog()->warn($e->getMessage());
    }

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
    if(!$this->request->isPost())
      return $this->_answerNotPost();

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

    $this->toolkit->getPostingService()->shareDayEnd($day);

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

    $this->toolkit->getPostingService()->shareDay($day);
    $this->toolkit->getNewsObserver()->onDayShare($day);

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

    $this->toolkit->getPostingService()->shareDayLike($day, $like);
    $this->toolkit->getNewsObserver()->onDayLike($day, $like);

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

    $this->toolkit->getPostingService()->shareDayUnlike($day, $like);
    $this->toolkit->getNewsObserver()->onDayUnlike($day, $like);

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

    $this->toolkit->getNewsObserver()->onDayDelete($day);

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

    $this->toolkit->getNewsObserver()->onDayRestore($day);

    return $this->_answerOk();
  }

  function doFollowing()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowing());

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

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayInterestingItems($days_ratings));
  }

  function doFavourite()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getFavouriteDaysWithLimitations($from, $to, $limit);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($days));
  }

  function doMarkFavourite()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(DayFavourite::isFavourited($this->_getUser(), $day))
      return $this->_answerConflict();

    $favourites = $this->_getUser()->getFavouriteDays();
    $favourites->add($day);
    $favourites->save();

    return $this->_answerOk();
  }

  function doUnmarkFavourite()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$day = Day::findById($this->request->id))
      return $this->_answerModelNotFoundById('Day', $this->request->id);

    if(!DayFavourite::findByDayIdAndUserId($day->getId(), $this->_getUser()->getId()))
      return $this->_answerOk(null, "Favourite not found");

    $favourites = $this->_getUser()->getFavouriteDays();
    $favourites->remove($day);
    $favourites->save();

    return $this->_answerOk();
  }

  function doMy()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $days = $this->_getUser()->getDaysWithLimitations($from, $to, $limit);

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
      $this->toolkit->getNewsObserver()->onMoment($moment);

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

      $this->toolkit->getNewsObserver()->onDayComment($comment);

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
