<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends lmbController
{
	function doDay()
	{
		$id = $this->request->get('id');

		$this->day = Day::findById($id);
		if (!$this->day || $this->day->is_deleted)
			return $this->forward('pages', 'not_found');
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
