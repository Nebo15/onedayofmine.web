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
		$raw_info = $provider->people_getInfo($this->user->flickr_uid);
		return [
			'id' => $raw_info['nsid'],
			'image' => "http://flickr.com/buddyicons/{$this->user->flickr_uid}.jpg",
			'image_width' => 48,
			'image_height' => 48,
			'name' => $raw_info['username'],
			'photos_count' => $raw_info['photos']['count']
		];
	}

	function getPhotos($from_stamp, $to_stamp = null)
	{
		if(!$this->user->flickr_uid)
			throw new lmbException("Flickr info not found for user #".$this->user->id);

		$options = [
			'user_id' => $this->user->flickr_uid,
			'max_taken_date' => $from_stamp,
			'extras' => 'date_taken,geo,tags,url_l',
		];
		if($to_stamp)
			$options['min_taken_date'] = $to_stamp;

		return $this->_getPhotos($options);
	}

	function getDays($from_stamp = null)
	{
		if(!$this->user->flickr_uid)
			throw new lmbException("Flickr info not found for user #".$this->user->id);

		$options = [
			//'user_id' => $this->user->flickr_uid,
			'extras' => 'date_taken,geo,tags,url_l',
		];
		if($from_stamp)
			$options['max_taken_date'] = $from_stamp;

		$days = [];
		$days_expected = 4;
		$photos = true;
		while($days_expected > 0 && $photos)
		{
			$photos = $this->_getPhotos($options);
			if(!count($days))
				$days[] = [array_shift($photos)];
			foreach($photos as $photo)
			{
				$current_day = end($days);
				$prev_photo = end($current_day);
				if(($prev_photo['time'] - $photo['time']) < 4*60*60)
				{
					$days[count($days) - 1][] = $photo;
				}
				else
				{
					$days[] = [$photo];
					$days_expected--;
				}
			}

			$current_day = end($days);
			$prev_photo = end($current_day);
			$options['max_taken_date'] = $prev_photo['time'];
		}

		foreach($days as $key => $day)
		{
			if(3 > count($day))
				unset($days[$key]);
		}
		return array_values($days);
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

	protected function _getPhotos($options)
	{
		$provider = new odFlickr($this->app_key, $this->app_secret);
		$provider->setToken($this->token);
		$photos = $provider->people_getPhotos('me', $options)['photos'];

		if($provider->getErrorMsg())
			throw new lmbException('Flickr API answer: '.$provider->getErrorMsg());

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
				'description' => '',
				'location_latitude' => (0 == $raw_photo['latitude']) ? null : $raw_photo['latitude'],
				'location_longitude' => (0 == $raw_photo['longitude']) ? null : $raw_photo['longitude'],
				'location_name' => null,
				'tags' => explode(' ', $raw_photo['tags']),
				'time' => (int) DateTime::createFromFormat('Y-m-d H:i:sP', $raw_photo['datetaken'].'+0000')->getTimestamp(),
			];
		}
		return $result;
	}
}
