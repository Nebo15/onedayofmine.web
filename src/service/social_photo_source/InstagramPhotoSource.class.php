<?php
lmb_require('src/service/social_photo_source/BaseSocialPhotoSource.class.php');

class InstagramPhotoSource extends BaseSocialPhotoSource
{
	protected $uid;
	protected $token;

	function __construct(User $user)
	{
		parent::__construct($user);
		$this->uid = $user->instagram_uid;
		$this->token = $user->instagram_token;
	}

	function getLoginUrl($redirect_url)
	{
		return "https://api.instagram.com/oauth/authorize/?client_id={$this->app_key}&redirect_uri=$redirect_url&response_type=code";
	}

	function login($code, $redirect_url)
	{
		$request = new HttpRequest('https://api.instagram.com/oauth/access_token', HTTP_METH_POST);
		$request->setPostFields([
			'client_id' => $this->app_key,
			'client_secret' => $this->app_secret,
			'grant_type' => 'authorization_code',
			'redirect_uri' => $redirect_url,
			'code' => $code
		]);
		$answer = $request->send();
		if($answer->getResponseCode() != 200)
		{
			$body = json_decode($answer->getBody());
			$message = (property_exists($body, 'meta')) ? $body->meta->error_message : $body->error_message;
			lmbToolkit::instance()->getLog()->error('Instagram API answer: '.$message);
			return null;
		}

		$info = json_decode($answer->getBody());
		$this->user->instagram_uid = $info->user->id;
		$this->user->instagram_token = $info->access_token;
		return $this->user->save();
	}

	function getUserInfo()
	{
		if(!$this->user->instagram_uid)
			throw new lmbException("Instagram info not found for user #".$this->user->id);

		$url = "https://api.instagram.com/v1/users/{$this->uid}/?access_token={$this->token}";
		$answer =  (new HttpRequest($url))->send();

		if($answer->getResponseCode() != 200)
			throw new lmbException('Instagram API answer: '.json_decode($answer->getBody())->meta->error_message);

		$raw_info = json_decode($answer->getBody())->data;
		return [
			'id' => $raw_info->id,
			'image' => $raw_info->profile_picture,
			'image_width' => 150,
			'image_height' => 150,
			'name' => $raw_info->username,
			'photos_count' => $raw_info->counts->media
		];
	}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		if(!$this->user->instagram_uid)
			throw new lmbException("Instagram info not found for user #".$this->user->id);

		$url = "https://api.instagram.com/v1/users/{$this->uid}/media/recent/?access_token={$this->token}";
		$url .= '&count='.self::LIMIT;
		$url .= "&max_timestamp=".$from_stamp;
		if($to_stamp)
			$url .= "&min_timestamp=".($to_stamp + 1);

		$answer = (new HttpRequest($url))->send();

		if($answer->getResponseCode() != 200)
		{
			lmbToolkit::instance()->getLog()->warn('Instagram API answer: '.$answer->getBody());
			return [];
		}

		$raw_info = json_decode($answer->getBody());
		$url = $raw_info->pagination && property_exists($raw_info, 'next_url') ? $raw_info->pagination->next_url : null;
		$result = [];
		foreach($raw_info->data as $raw_photo)
		{
			$latitude = $raw_photo->location && property_exists($raw_photo->location, 'latitude')
					? $raw_photo->location->latitude : null;
			$longitude = $raw_photo->location && property_exists($raw_photo->location, 'longitude')
					? $raw_photo->location->longitude : null;
			$location = $raw_photo->location && property_exists($raw_photo->location, 'name')
					? $raw_photo->location->name : null;

			$one_result = [
				'id' => $raw_photo->id,
				'title' => $raw_photo->caption ? $raw_photo->caption->text : '',
				'description' => '',
				'location_latitude' => $latitude,
				'location_longitude' => $longitude,
				'location_name' => $location,
				'tags' => $raw_photo->tags,
				'time' => (int) $raw_photo->created_time,
			];

			// instagram bug https://groups.google.com/forum/?fromgroups=#!topic/instagram-api-developers/ncB18unjqyg
			if(property_exists($raw_photo->images->standard_resolution, 'url'))
			{
				$one_result['image'] = $raw_photo->images->standard_resolution->url;
				$one_result['image_width'] = $raw_photo->images->standard_resolution->width;
				$one_result['image_height'] = $raw_photo->images->standard_resolution->height;
			}
			else
			{
				$one_result['image'] = $raw_photo->images->standard_resolution;
				$one_result['image_width'] = null;
				$one_result['image_height'] = null;
			}

			if(property_exists($raw_photo->images->thumbnail, 'url'))
			{
				$one_result['thumb'] = $raw_photo->images->thumbnail->url;
				$one_result['thumb_width'] = $raw_photo->images->thumbnail->width;
				$one_result['thumb_height'] = $raw_photo->images->thumbnail->height;
			}
			else
			{
				$one_result['thumb'] = $raw_photo->images->standard_resolution;
				$one_result['thumb_width'] = null;
				$one_result['thumb_height'] = null;
			}

			$result[] = $one_result;
		}
		return $result;
	}

	function logout()
	{
		if(!$this->user->instagram_uid)
			throw new lmbException("Instagram info not found for user #".$this->user->id);

		$this->user->instagram_uid = '';
		$this->user->instagram_token = '';
		return $this->user->save();
	}

	protected function getConfig()
	{
		return lmbToolkit::instance()->getConf('common')->instagram;
	}
}
