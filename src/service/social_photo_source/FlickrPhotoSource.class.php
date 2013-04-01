<?php
lmb_require('src/service/social_photo_source/BaseSocialPhotoSource.class.php');
lmb_require('src/service/social_provider/odFlickr.class.php');

class FlickrPhotoSource extends BaseSocialPhotoSource
{
	protected $uid;
	protected $token;

	function __construct(User $user)
	{
		parent::__construct($user);
		$this->uid = $user->flickr_uid;
		$this->token = $user->flickr_token;
	}

	function getLoginUrl($redirect_url)
	{
		$provider = new odFlickr($this->app_key, $this->app_secret);
		return $provider->auth_build_url();
	}

	function login($code, $redirect_url)
	{
		$provider = new odFlickr($this->app_key, $this->app_secret);
		$answer = $provider->auth_getToken($code);
		$this->user->flickr_uid = $answer['user']['nsid'];
		$this->user->flickr_token = $answer['token'];
		return $this->user->save();
	}

	function getUserInfo()
	{
		if(!$this->user->flickr_uid)
			throw new lmbException("Flickr info not found for user #".$this->user->id);

		$provider = new odFlickr($this->app_key, $this->app_secret);
		$raw_info = $provider->people_getInfo($this->uid);
		return [
			'id' => $raw_info['nsid'],
			'image' => "http://flickr.com/buddyicons/{$this->uid}.jpg",
			'image_width' => 48,
			'image_height' => 48,
			'name' => $raw_info['username'],
			'photos_count' => $raw_info['photos']['count']
		];
	}

	function getPhotos($from_stamp = null, $to_stamp = null)
	{
		if(!$this->user->flickr_uid)
			throw new lmbException("Flickr info not found for user #".$this->user->id);

		$provider = new odFlickr($this->app_key, $this->app_secret);
		$provider->setToken($this->token);

		$options = [
			'user_id' => $this->uid,
			'extras' => 'date_taken,geo,tags,url_l,url_q',
			'content_type' => 1,
			'media' => 'photos',
			'sort' => 'date-taken-desc',
			'per_page' => self::LIMIT
		];


		if($from_stamp)
		{
			$datetime = new DateTime();
			$datetime->setTimestamp($from_stamp - 1);
			$datetime->setTimezone(new DateTimeZone('UTC'));
			$options['max_taken_date'] = $datetime->format('Y-m-d H:i:s');
		}
		if($to_stamp)
		{
			$datetime = new DateTime();
			$datetime->setTimestamp($to_stamp + 1);
			$datetime->setTimezone(new DateTimeZone('UTC'));
			$options['min_taken_date'] = $datetime->format('Y-m-d H:i:s');
		}
		$photos = $provider->photos_search($options);

		if($provider->getErrorMsg())
		{
			lmbToolkit::instance()->getLog()->error('Flickr API answer: '.$provider->getErrorMsg());
			return [];
		}

		if(!isset($photos['photo']))
		{
			lmbToolkit::instance()->getLog()->error("Flickr API answer without 'photo' section: ".$provider->getErrorMsg());
			return [];
		}

		$result = [];
		foreach($photos['photo'] as $raw_photo)
		{
			if(!isset($raw_photo['url_l']))
				continue;
			$result[] = [
				'id' => $raw_photo['id'],
				'title' => $raw_photo['title'],
				'image' => $raw_photo['url_l'],
				'image_width' => $raw_photo['width_l'],
				'image_height' => $raw_photo['height_l'],
				'thumb' => $raw_photo['url_q'],
				'thumb_width' => $raw_photo['width_q'],
				'thumb_height' => $raw_photo['height_q'],
				'description' => '',
				'location_latitude' => (0 == $raw_photo['latitude']) ? null : $raw_photo['latitude'],
				'location_longitude' => (0 == $raw_photo['longitude']) ? null : $raw_photo['longitude'],
				'location_name' => null,
				'tags' => explode(' ', $raw_photo['tags']),
				'time' => (int) DateTime::createFromFormat('Y-m-d H:i:sP', $raw_photo['datetaken'].'+0000')->getTimestamp()
			];
		}
		return $result;
	}

	function logout()
	{
		if(!$this->user->flickr_uid)
			throw new lmbException("Flickr info not found for user #".$this->user->id);

		$this->user->flickr_uid = '';
		$this->user->flickr_token = '';
		return $this->user->save();
	}

	protected function getConfig()
	{
		return lmbToolkit::instance()->getConf('common')->flickr;
	}
}
