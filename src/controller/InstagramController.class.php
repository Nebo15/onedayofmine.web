<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/service/social_photo_source/InstagramPhotoSource.class.php');

class InstagramController extends BaseJsonController
{
	function doLoginUrl()
	{
		$service = new InstagramPhotoSource($this->_getUser());
		if($this->_getUser()->instagram_uid)
			return $this->_answerOk();
		else
			return $this->_answerOk($service->getLoginUrl($this->toolkit->getSiteUrl('instagram/login/')));
	}

	function doLogin()
	{
		$service = new InstagramPhotoSource($this->_getUser());
		$updated_user = $service->login($this->request->get('code'), $this->toolkit->getSiteUrl('instagram/login/'));
		return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($updated_user));
	}

	function doUser()
	{
		$service = new InstagramPhotoSource($this->_getUser());
		return $this->_answerOk($service->getUserInfo());
	}

	function doPhotos()
	{
		$service = new InstagramPhotoSource($this->_getUser());
		return $this->_answerOk(
			$service->getPhotos(
				$this->request->getInteger('id'),
				$this->request->getInteger('another_id')
			)
		);
	}

	function doDays()
	{
		$service = new InstagramPhotoSource($this->_getUser());
		return $this->_answerOk($service->getDays($this->request->getInteger('id')));
	}

	function doLogout()
	{
		if(!$this->request->isPost())
			return $this->_answerNotPost();
		$service = new InstagramPhotoSource($this->_getUser());
		return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($service->logout()));
	}
}
