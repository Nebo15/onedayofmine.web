<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/social_photo_source/CachedPhotoSource.class.php');
lmb_require('src/service/social_photo_source/MergedPhotoSource.class.php');

class ImportController extends BaseJsonController
{
	function doPhotos()
	{
		$service = new CachedPhotoSource(new MergedPhotoSource($this->_getUser()));
		return $this->_answerOk(
			$service->getPhotos(
				$this->request->getInteger('from'),
				$this->request->getInteger('to')
			)
		);
	}

	function doDays()
	{
		$service = new CachedPhotoSource(new MergedPhotoSource($this->_getUser()));
		return $this->_answerOk($service->getDays($this->request->getInteger('from')));
	}
}