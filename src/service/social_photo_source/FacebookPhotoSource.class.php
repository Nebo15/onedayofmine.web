<?php
lmb_require('src/service/social_photo_source/BaseSocialPhotoSource.class.php');

class FacebookPhotoSource extends BaseSocialPhotoSource
{
	function getLoginUrl($redirect_url) {}
	function login($code, $redirect_url) {}

	function getUserInfo()
	{
		/* @var FacebookProfile */
		$profile = lmbToolkit::instance()->getFacebookProfile($this->user);
		$raw_info = $profile->getInfo();

		$sizes = $profile->getProvider()->makeQuery('SELECT size FROM album WHERE owner = me();');
		$totalPhotos = 0;
		if($sizes) {
			foreach($sizes as $album){
				$totalPhotos += $album['size'];
			}
		}
		return [
			'id' => $raw_info['facebook_uid'],
			'image' => $raw_info['pic_square'],
			'image_width' => 50,
			'image_height' => 50,
			'name' => $raw_info['name'],
			'photos_count' => $totalPhotos
		];
	}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		$profile = lmbToolkit::instance()->getFacebookProfile($this->user);
		$fql = "SELECT "
				."pid,caption,src_big,src_big_width,src_big_height,caption_tags,created,backdated_time "
				." FROM photo WHERE owner = me() "
				.($from_stamp ? " AND created < ".$from_stamp : "")
				.($to_stamp ? " AND created > ".$to_stamp : "")
				."ORDER BY created DESC";
		$photos = $profile->getProvider()->makeQuery($fql);

		$result = [];
		foreach($photos as $raw_photo)
		{
			$result[] = [
				'id' => $raw_photo['pid'],
				'title' => $raw_photo['caption'],
				'image' => $raw_photo['src_big'],
				'image_width' => $raw_photo['src_big_width'],
				'image_height' => $raw_photo['src_big_height'],
				'thumb' => $raw_photo['src_big'],
				'thumb_width' => $raw_photo['src_big_width'],
				'thumb_height' => $raw_photo['src_big_height'],
				'description' => '',
				'location_latitude' => null,
				'location_longitude' => null,
				'location_name' => null,
				'tags' => $raw_photo['caption_tags'],
				'time' => (int) $raw_photo['created'],
			];
		}
		return $result;
	}

	function logout() {}
	protected function getConfig(){}
}
