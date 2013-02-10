<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends lmbController
{
	/**
	 * @var odTools
	 */
	protected $toolkit;
	protected $instagram_api_host = 'https://api.instagram.com';

	function doDayCreate()
	{
		return $this->doImport();
	}

	function doDisplay()
	{
		if($this->toolkit->getUser())
			return $this->doImport();
		else
		{
			$this->setTemplate('pages/display_guest.phtml');
		}
	}

	function doDaysDiscover()
	{
		$days_ratings = (new InterestCalculator())->getDaysRatings();

		$this->days = [];
		foreach ($days_ratings as $day_rating)
			$this->days[] = $this->toolkit->getExportHelper()->exportDay($day_rating->getDay());
	}

	function doMyDays()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$this->days = $this->toolkit->getExportHelper()->exportDayItems($user->getDays());
	}

	function doDay()
	{
		if (!$day = Day::findById($this->request->id))
			return $this->forwardTo404();

		if ($day->is_deleted)
			return $this->forwardTo404();

		if (!$this->toolkit->getUser() || $this->toolkit->getUser()->id != $day->user_id)
		{
			$day->views_count = $day->views_count + 1;
			$day->save();
		}

    $this->is_owner = false;
    if ($this->toolkit->getUser() && $this->toolkit->getUser()->id == $day->user_id)
      $this->is_owner = true;

    $this->day = $this->toolkit->getExportHelper()->exportDay($day);

    $this->day->utime = date('m/d/y', $this->day->utime);
    $this->day->ctime = date('m/d/y', $this->day->ctime);

    foreach ($this->day->moments as $moment) {
      $moment->time = date('h:i', strtotime($moment->time));
    }
	}

	function doMoment()
	{
		$id = $this->request->get('id');

		$this->moment = Moment::findById($id);
		if (!$this->moment || $this->moment->getDay()->is_deleted)
			return $this->forwardTo404();
	}

	function doImport()
	{
		$this->facebook_app_id = $this->toolkit->getConf('facebook')->appId;
		$this->instagram = $this->toolkit->getConf('common')->instagram;
	}

	function doUser()
	{
		if(!$id = $this->request->get('id'))
			return $this->forwardTo404();

		if(!$user = User::findById($id))
			return $this->forwardTo404();

		$this->user = (array) $this->toolkit->getExportHelper()->exportUser($user);
		$this->user['days'] = (array) $this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays());
	}

	function doNotFound()
	{
		$this->response->setCode(404);
	}

	function forwardTo404()
	{
		$this->response->setCode(404);
		$this->setTemplate('pages/not_found.phtml');
	}

	function forwardToUnauthorized()
	{
		$this->response->setCode(401);
		$this->setTemplate('pages/not_authorized.phtml');
	}

	function performAction()
	{
		$this->current_user = $this->toolkit->getUser()
				? (array) $this->toolkit->getExportHelper()->exportUser($this->toolkit->getUser())
				: new stdClass;
		return parent::performAction();
	}
}
