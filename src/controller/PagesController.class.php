<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends lmbController
{
	function doDaysDiscover()
	{
		$days_ratings = (new InterestCalculator())->getDaysRatings(0, 20, 20);

		$this->days = [];
		foreach ($days_ratings as $day_rating)
			$this->days[] = $this->toolkit->getExportHelper()->exportDay($day_rating->getDay());
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

		$this->day = $this->toolkit->getExportHelper()->exportDay($day);
	}

	function doMoment()
	{
		$id = $this->request->get('id');

		$this->moment = Moment::findById($id);
		if (!$this->moment || $this->moment->getDay()->is_deleted)
			return $this->forward('pages', 'not_found');
	}

	function doNotFound()
	{
		$this->response->setCode(404);
	}
}
