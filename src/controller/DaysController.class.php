<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/service/ExternalPhotosAnalyzer.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/EditorAction.class.php');
lmb_require('src/model/DayFavorite.class.php');
lmb_require('src/model/Complaint.class.php');
lmb_require('src/model/DayJournalRecord.class.php');
lmb_require('limb/datetime/src/lmbDateTime.class.php');

class DaysController extends BaseJsonController
{
	function doGuestItem()
	{
		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if ($day->is_deleted)
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (!$this->_getUser() || $this->_getUser()->id != $day->user_id)
		{
			$day->views_count = $day->views_count + 1;
			$day->save();
		}

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
	}

	function doStart()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		$errors = $this->_checkPropertiesInRequest(array('title', 'type'));
		if (count($errors))
			return $this->_answerWithError($errors);

    $date = (string) $this->request->getPostFiltered('date', FILTER_SANITIZE_STRING);
    if(!lmbDateTime :: validate($date))
      return $this->_answerWithError('Date format is incorrect, valid format is Y-m-d');

		$day = new Day();
		$day->setUser($this->_getUser());
		$day->title = $this->request->getPostFiltered('title', FILTER_SANITIZE_STRING);
		$day->type = $this->request->getPost('type');
		$day->location_str = $this->request->getPostFiltered('location_str', FILTER_SANITIZE_STRING);
		$day->location_lat = $this->request->getPostFiltered('location_lat', FILTER_SANITIZE_NUMBER_FLOAT);
		$day->location_long = $this->request->getPostFiltered('location_long', FILTER_SANITIZE_NUMBER_FLOAT);
		$day->final_description = $this->request->getPostFiltered('final_description', FILTER_SANITIZE_STRING);
    $day->date = $date ?: date('Y-m-d');
		$day->save();

		$user = $this->_getUser();
		$user->setCurrentDay($day);
		$user->save();

		$day->getDbConnection()->commitTransaction();

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
	}

	function doUpdate()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (!$this->_canEditDay($day))
			return $this->_answerNotOwner();

		$orig_day = clone($day);

		if ($this->request->get('cover_content'))
		{
			$day->attachImage(base64_decode($this->request->get('cover_content')));
			$day->save();
		}

		if ($cover_moment_id = $this->request->get('cover_moment_id'))
		{
			$cover_moment = Moment::findById($cover_moment_id);
			$url = $this->toolkit->getStaticUrl($cover_moment->getImage(['width' => 532]));
			$day->attachImage(file_get_contents($url));
			$day->save();
		}

		$this->_importSaveAndAnswer(
			$day,
			['title', 'occupation', 'location_str', 'location_lat', 'location_long', 'type', 'final_description']
		);

    if ($this->request->has('date'))
    {
      $date = (string) $this->request->getPostFiltered('date', FILTER_SANITIZE_STRING);
      if(!lmbDateTime :: validate($date))
        return $this->_answerWithError('Date format is incorrect, valid format is Y-m-d');

      $day->date = $date;
      $day->save();
    }

		if($this->_getUser()->is_editor && $this->_getUser()->id != $day->user_id)
		{
			$action = new EditorAction();
			$action->setUser($this->_getUser());
			$action->day_id = $day->id;
			$action->fillAction($orig_day, $day);
			$action->save();
		}

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
	}

	function doCurrent()
	{
		if (!$day = Day::findById($this->_getUser()->current_day_id))
			return $this->_answerNotFound('Current day not set');

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
	}

	function doFinish()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		$user = $this->_getUser();
		if ($day->user_id != $user->id)
			return $this->_answerNotOwner();

		if ($day->id == $user->current_day_id)
		{
			$user->current_day_id = 0;
			$user->save();
		}

		if ($this->request->get('image_content'))
		{
			$day->attachImage(base64_decode($this->request->get('image_content')));
			$day->save();
		}

		if ($this->request->get('final_description'))
		{
			$day->final_description = $this->request->get('final_description');
			$day->save();
		}

		$this->toolkit->doAsync('shareDayEnd', $day->id);

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDay($day));
	}

	function doMarkCurrent()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		$user = $this->_getUser();
		$user->setCurrentDay($day);
		$user->save();

		return $this->_answerOk();
	}

	function doShare()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		$this->toolkit->doAsync('shareDay', $day->id);

		return $this->_answerOk();
	}

	function doLike()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (DayLike::findByDayIdAndUserId($day->id, $this->_getUser()->id))
      return $this->_answerConflict();

    if ($day->getUser()->id == $this->_getUser()->id)
			return $this->_answerOk("You can't like your own day");

		$like = new DayLike;
		$like->setDay($day);
		$like->setUser($this->_getUser());
		$like->save();

		try
		{
			$this->toolkit->doAsync('dayLike', $day->id, $like->id);
		}
		catch(FacebookApiException $e) {}

		return $this->_answerOk();
	}

	function doUnlike()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (!$like = DayLike::findByDayIdAndUserId($day->id, $this->_getUser()->id))
			return $this->_answerOk(null, "Like not found");

		$this->toolkit->doAsync('dayUnlike', $day->id, $like->id);

		$like->destroy();

		return $this->_answerOk();
	}

	function doDelete()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if ($day->user_id != $this->_getUser()->id)
			return $this->_answerNotOwner();

		$user = $this->_getUser();
		if ($user->current_day_id == $day->id)
		{
			$user->current_day_id = false;
			$user->save();
		}

		$day->is_deleted = 1;
		$day->save();

		$this->toolkit->doAsync('dayDelete', $day->id);

		return $this->_answerOk();
	}

	function doRestore()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if ($day->user_id != $this->_getUser()->id)
			return $this->_answerNotOwner();

		$day->is_deleted = 0;
		$day->save();

		$this->toolkit->doAsync('dayRestore', $day->id);

		return $this->_answerOk();
	}

	function doGuestJournal()
	{
		list($from, $to, $limit) = $this->_getFromToLimitations();
		$days = $this->toolkit->getExportHelper()->exportDayItems(
			DayJournalRecord::findDaysWithLimitation($from, $to, $limit)
		);
		foreach($days as $i => $day)
			$days[$i]->date = date('Y-m-d', $day->utime);
		return $this->_answerOk($days);
	}

	function doFollowing()
	{
		list($from, $to, $limit) = $this->_getFromToLimitations();
		$users_ids = lmbArrayHelper::getColumnValues('id', $this->_getUser()->getFollowingUsers());

		if (!count($users_ids))
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
		foreach ($days_ratings as $day_rating)
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
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (DayFavorite::isFavorited($this->_getUser(), $day))
			return $this->_answerConflict();

		$link = new DayFavorite();
		$link->setUser($this->_getUser());
		$link->setDay($day);
		$link->save();

		return $this->_answerOk();
	}

	function doUnmarkFavorite()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (!$favorite = DayFavorite::findByDayIdAndUserId($day->id, $this->_getUser()->id))
			return $this->_answerOk(null, "Favorite not found");

		$favorite->destroy();

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
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		$errors = $this->_checkPropertiesInRequest(['position']);
		if (count($errors))
			return $this->_answerWithError($errors);

		if(!$this->request->get('image_content') && !$this->request->get('image_url'))
			return $this->_answerWithError("image_content or image_url must be in request");

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if (!$this->_canEditDay($day))
				return $this->_answerNotOwner();

		if($this->request->get('image_content'))
		{
			$image_content = base64_decode($this->request->get('image_content'));
		}
		else
		{
			$image_content = file_get_contents($this->request->get('image_url'));
		}

		$moment = new Moment();
		$moment->setDay($day);
		$moment->description = $this->request->get('description', '');
		$moment->time = time();
		$moment->position = $this->request->getInteger('position');
		$moment->timezone = $this->toolkit->getUser()->timezone;
		$moment->instagram_id = $this->request->get('instagram_id', '');
		$moment->flickr_id = $this->request->get('flickr_id', '');
		$moment->facebook_id = $this->request->get('facebook_id', '');
		$moment->location_latitude = $this->request->getInteger('location_latitude', 0);
		$moment->location_longitude = $this->request->getInteger('location_longitude', 0);
		$moment->save();

		$moment->attachImage($image_content);

		if ($this->request->get('time'))
		{
			list($time, $timezone) = Moment::isoToStamp($this->request->get('time'));
			$moment->time = $time;
			$moment->timezone = $timezone;
		}
		$moment->save();

		$moment->getDbConnection()->commitTransaction();

		if($this->_getUser()->is_editor && $this->_getUser()->id != $day->user_id)
		{
			$action = new EditorAction();
			$action->setUser($this->_getUser());
			$action->moment_id = $moment->id;
			$action->fillAction(new Moment(), $moment);
			$action->save();
		}

		if ($this->error_list->isEmpty())
		{
			$this->toolkit->doAsync('momentCreate', $moment->id);
			return $this->_answerOk($this->toolkit->getExportHelper()->exportMoment($moment));
		}
		else
			return $this->_answerWithError($this->error_list->export());
	}

	function doComment()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		$comment = new DayComment();
		$comment->text = $this->request->get('text');
		$comment->setDay($day);
		$comment->setUser($this->_getUser());
		$comment->validate($this->error_list);

		if ($this->error_list->isEmpty())
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
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		$complaint = new Complaint();
		$complaint->setDay($day);
		$complaint->text = $this->request->get('text');

		$complaint->validate($this->error_list);
		if ($this->error_list->isValid())
		{
			$complaint->saveSkipValidation();
			$this->toolkit
					->getMailService('complain')
					->set('complain', $complaint)
					->set('host', lmb_env_get('HOST_URL'))
					->send('alert@onedayofmine.com');
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
		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		list($from, $to, $limit) = $this->_getFromToLimitations();

		return $this->_answerOk($this->toolkit->getExportHelper()->exportDayCommentItems($day->getCommentsWithLimitation($from,
			$to, $limit)));
	}

	function doGuestAnalyzeExternalDay()
	{
		$service = new ExternalPhotosAnalyzer($this->_getUser());
		return $this->_answerOk($service->analyze($this->request->get('day')));
	}

	function doMomentsGatheringEnable()
	{
		return $this->_changeGatheringAction(1);
	}

	function doMomentsGatheringDisable()
	{
		return $this->_changeGatheringAction(0);
	}

	function doAddToJournal()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if(!$this->_getUser()->is_editor)
			return $this->_answerNotFound();

		$record = new DayJournalRecord();
		$record->day_id = $this->request->getInteger('id');
		$record->user_id = $this->_getUser()->id;
		$record->save();

		return $this->_answerOk();
	}

	function doRemoveFromJournal()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if(!$this->_getUser()->is_editor)
			return $this->_answerNotFound();

		DayJournalRecord::findByDayId($this->request->getInteger('id'))->destroy();

		return $this->_answerOk();
	}

	protected function _changeGatheringAction($value)
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if (!$day = Day::findById($this->request->id))
			return $this->_answerModelNotFoundById('Day', $this->request->id);

		if ($day->user_id != $this->_getUser()->id)
			return $this->_answerNotOwner();

		$day->is_gathering_enabled = $value;
		$day->saveSkipValidation();

		if($value)
			$this->toolkit->doAsync('dayEnableGathering', $day->id);

		return $this->_answerOk();
	}

	function _canEditDay($day)
	{
		return $this->_getUser() && ($this->_getUser()->id == $day->user_id || $this->_getUser()->is_editor);
	}
}
