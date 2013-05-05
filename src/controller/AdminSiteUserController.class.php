<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/service/social_photo_source/InstagramPhotoSource.class.php');

class AdminSiteUserController extends lmbAdminObjectController
{
  protected $_object_class_name = 'User';

	function doRedirectToInstagram()
	{
		$user = User::findById($this->request->getInteger('id'));
		$this->url = 'http://instagram.com/'.(new InstagramPhotoSource($user))->getUserInfo()['name'];
		$this->setTemplate('admin_site_user/redirect.phtml');
	}
}
