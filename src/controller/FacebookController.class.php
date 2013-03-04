<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/service/social_photo_source/FacebookPhotoSource.class.php');

class FacebookController extends BaseJsonController
{
	function doUser()
	{
		$service = new FacebookPhotoSource($this->_getUser());
		return $this->_answerOk($service->getUserInfo());
	}

	function doPhotos()
	{
		$service = new FacebookPhotoSource($this->_getUser());
		return $this->_answerOk(
			$service->getPhotos(
				$this->request->getInteger('from'),
				$this->request->getInteger('to')
			)
		);
	}

	function doDays()
	{
		$service = new FacebookPhotoSource($this->_getUser());
		return $this->_answerOk($service->getDays($this->request->getInteger('from')));
	}
}
