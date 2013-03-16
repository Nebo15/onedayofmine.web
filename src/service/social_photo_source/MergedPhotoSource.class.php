<?php
lmb_require('src/service/social_photo_source/BaseSocialPhotoSource.class.php');
lmb_require('src/service/social_photo_source/FacebookPhotoSource.class.php');
lmb_require('src/service/social_photo_source/InstagramPhotoSource.class.php');
lmb_require('src/service/social_photo_source/FlickrPhotoSource.class.php');

class MergedPhotoSource extends BaseSocialPhotoSource
{
	protected function getConfig() {}
	function getLoginUrl($redirect_url) {}
	function login($code, $redirect_url) {}
	function logout() {}
	function getUserInfo() {}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		$user = $this->user;
		$sources = ['facebook' => new FacebookPhotoSource($user)];
		if($user->instagram_uid)
			$sources['instagram'] = new InstagramPhotoSource($user);
		if($user->flickr_uid)
			$sources['flickr'] = new FlickrPhotoSource($user);

		$result = [];
		foreach($sources as $name => $source)
			foreach($source->getPhotos($from_stamp, $to_stamp) as $photo)
			{
				$photo['service'] = $name;
				$result[$photo['time'].substr($photo['id'], -4)] = $photo;
			}

		ksort($result);
		return array_reverse(array_values($result));
	}
}