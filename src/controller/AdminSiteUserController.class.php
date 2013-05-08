<?php
lmb_require('src/controller/AdminObjectController.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/service/social_photo_source/InstagramPhotoSource.class.php');

class AdminSiteUserController extends AdminObjectController
{
  protected $_object_class_name = 'User';
	protected $_default_sort = ['id' => 'desc'];

	function doRedirectToInstagram()
	{
		$user = User::findById($this->request->getInteger('id'));
		$this->url = 'http://instagram.com/'.(new InstagramPhotoSource($user))->getUserInfo()['name'];
		$this->setTemplate('admin_site_user/redirect.phtml');
	}
}
