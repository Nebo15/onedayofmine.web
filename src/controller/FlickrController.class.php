<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/service/social_photo_source/FlickrPhotoSource.class.php');

class FlickrController extends BaseJsonController
{
  function doLogin()
  {
    $service = new FlickrPhotoSource($this->_getUser());
    $redirect_url = '';

    if($this->request->has('frob')) {
      $service->login($this->request->get('frob'), $this->toolkit->getSiteUrl());

      if($this->toolkit->getSessionStorage()->get('oauth_redirect_url')) {
        $redirect_url = $this->toolkit->getSessionStorage()->get('oauth_redirect_url');
        $this->toolkit->getSessionStorage()->delete('oauth_redirect_url');
      } elseif(is_array($_SERVER) && array_key_exists('HTTP_REFERER', $_SERVER)) {
        $referer = new lmbUri($_SERVER['HTTP_REFERER']);
        $redirect_url = $referer->toString($parts = array('path', 'query', 'anchor'));
      }
    } else {
      if($this->request->has('oauth_redirect_url')) {
        $url = new lmbUri($this->request->get('oauth_redirect_url'));
        $this->toolkit->getSessionStorage()->set('oauth_redirect_url', $url->toString($parts = array('path', 'query', 'anchor')));
      }
      $redirect_url = $service->getLoginUrl($this->toolkit->getSiteUrl('instagram/login/'));
    }

    if($redirect_url)
      $this->redirect($redirect_url);

    return $this->_answerOk();
  }

	function doUser()
	{
		$service = new FlickrPhotoSource($this->_getUser());
		return $this->_answerOk($service->getUserInfo());
	}

	function doPhotos()
	{
		$service = new FlickrPhotoSource($this->_getUser());
		return $this->_answerOk(
			$service->getPhotos(
				$this->request->getInteger('from'),
				$this->request->getInteger('to')
			)
		);
	}

	function doDays()
	{
		$service = new FlickrPhotoSource($this->_getUser());
		return $this->_answerOk($service->getDays($this->request->getInteger('from')));
	}

	function doLogout()
	{
		if(!$this->request->isPost())
			return $this->_answerNotPost();

		$service = new FlickrPhotoSource($this->_getUser());
		return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($service->logout()));
	}
}
