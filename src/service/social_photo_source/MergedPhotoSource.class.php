<?php
lmb_require('src/service/social_photo_source/BasePhotoSource.class.php');
lmb_require('src/service/social_photo_source/CachedPhotoSource.class.php');
lmb_require('src/service/social_photo_source/FacebookPhotoSource.class.php');
lmb_require('src/service/social_photo_source/InstagramPhotoSource.class.php');
lmb_require('src/service/social_photo_source/FlickrPhotoSource.class.php');

class MergedPhotoSource extends BasePhotoSource
{
	/**
	 * @var User
	 */
	protected $user;

	function __construct(User $user)
	{
		$this->user = $user;
	}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		$user = $this->user;
		$sources = ['facebook' => new CachedPhotoSource(new FacebookPhotoSource($this->user))];
		if($user->instagram_uid)
			$sources['instagram'] = new CachedPhotoSource(new InstagramPhotoSource($this->user));
		if($user->flickr_uid)
			$sources['flickr'] = new CachedPhotoSource(new FlickrPhotoSource($this->user));

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