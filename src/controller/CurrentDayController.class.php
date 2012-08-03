<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class CurrentDayController extends BaseJsonController
{
	function doDisplay()
	{
		if(!$day = Day::findUnfinished($this->_getUser()))
			return $this->_answerNotFound('Unfinished day not found');

		return $this->_answerOk($day);
	}

	function doStart()
	{
		$day = new Day();
		$day->setIsEnded(0);

		if(!$this->request->hasPost())
			return $this->_answerWithError('Not a POST request', null, 405);

		$day->setUser($this->_getUser());
		$day->setOccupation($this->request->getPost('occupation') ?: $this->_getUser()->getOccupation());

		$response = $this->_importSaveAndAnswer($day, array('title', 'timezone', 'location', 'type'));

    $this->_getUser()
        ->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)
        ->shareDayBegin($day, $this->toolkit->getSiteUrl('/pages/'.$day->getId().'/day'));

		// Notify friends about new day
    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_DAY, $day);

		return $response;
	}

  function doUpdate()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    if(!$day = Day::findUnfinished($this->_getUser()))
      return $this->_answerNotFound('Unfinished day not found');

    $response = $this->_importSaveAndAnswer($day, array('title', 'occupation', 'timezone', 'location', 'type'));

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

		$errors = $this->_checkPropertiesInRequest(array('description', 'image_name', 'image_content'));
		if(count($errors))
			return $this->_answerWithError($errors);

		if(!$day = Day::findUnfinished($this->_getUser()))
			return $this->_answerNotFound('Unfinished day not found');

    if(!count($day->getMoments()) || $this->request->get('is_cover'))
    {
      $day->attachImage(
        $this->request->get('image_name'),
        base64_decode($this->request->get('image_content'))
      );
    }

		$moment = new Moment();
		$moment->setDay($day);
		$moment->setDescription($this->request->get('description'));
		$moment->save();
		$moment->attachImage(
				$this->request->get('image_name'),
				base64_decode($this->request->get('image_content'))
		);
		$moment->save();

		if($this->error_list->isEmpty()) {
			// Notify friends about new moment
	    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_MOMENT, $moment);

			return $this->_answerOk($moment->exportForApi());
		}
		else
			return $this->_answerWithError($this->error_list->export());
	}

}
