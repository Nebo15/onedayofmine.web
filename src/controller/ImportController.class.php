<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/social_photo_source/MergedPhotoSource.class.php');

class ImportController extends BaseJsonController
{
	function doPhotos()
	{
		$from = $this->request->getInteger('from');
		$to = $this->request->getInteger('to');

		$cache = $this->toolkit->getCache('photo_sources');
		$key = 'photos_'.$this->_getUser()->id.'_'.$from.'_'.$to;

		if(!$result = $cache->get($key))
		{
			$result = $this->_answerOk((new MergedPhotoSource($this->_getUser()))->getPhotos($from, $to));
			$cache->set($key, $result, 60 * 15);
		}

		return $result;
	}

	function doDays()
	{
		$from = $this->request->getInteger('from');

		$cache = $this->toolkit->getCache('photo_sources');
		$key = 'days_'.$this->_getUser()->id.'_'.$from;

		if(!$result = $cache->get($key))
		{
			$result = $this->_answerOk((new MergedPhotoSource($this->_getUser()))->getDays($from));
			$cache->set($key, $result, 60 * 5);
		}
		return $result;
	}
}