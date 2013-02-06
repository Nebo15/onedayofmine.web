<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends lmbController
{
	protected $instagram_api_host = 'https://api.instagram.com';

	function doDaysDiscover()
	{
		$days_ratings = (new InterestCalculator())->getDaysRatings();

		$this->days = [];
		foreach ($days_ratings as $day_rating)
			$this->days[] = $this->toolkit->getExportHelper()->exportDay($day_rating->getDay());
	}

	function doDay()
	{
		if (!$day = Day::findById($this->request->id))
			return $this->forwardTo404();

		if ($day->is_deleted)
			return $this->forwardTo404();

		if (!$this->toolkit->getUser() || $this->toolkit->getUser()->id != $day->user_id)
		{
			$day->views_count = $day->views_count + 1;
			$day->save();
		}

		$this->day = $this->toolkit->getExportHelper()->exportDay($day);
	}

	function doMoment()
	{
		$id = $this->request->get('id');

		$this->moment = Moment::findById($id);
		if (!$this->moment || $this->moment->getDay()->is_deleted)
			return $this->forward('pages', 'not_found');
	}

	function doNotFound()
	{
		$this->response->setCode(404);
	}

	function doImport()
	{
		$this->facebook_app_id = $this->toolkit->getConf('facebook')->appId;
		$this->instagram = $this->toolkit->getConf('common')->instagram;
	}

	function doInstagram()
	{
		$code = $this->request->get('code');
		$conf = $this->toolkit->getConf('common')->instagram;
		$req = new HttpRequest($this->instagram_api_host.'/oauth/access_token', HTTP_METH_POST);
		$req->setPostFields([
			'client_id' => $conf['client_id'],
			'client_secret' => $conf['client_secret'],
			'grant_type' => 'authorization_code',
			'redirect_uri' => $conf['redirect_url'],
			'code' => $code,
		]);
		$this->user = json_decode($req->send()->getBody());

		var_dump($this->user);die();

		$response = [];
		$photos = $this->_get_photos_recursively($this->instagram_api_host.'/v1/users/self/media/recent/?access_token='.$this->user->access_token);

		$response['photos_count'] = count($photos);

		$days = [[array_shift($photos)]];
		foreach ($photos as $photo)
		{
			$current_day = $days[count($days) - 1];
			$prev_photo = $current_day[count($current_day) - 1];
			if (($photo->time - $prev_photo->time) < 4 * 60 * 60)
			{
				$days[count($days) - 1][] = $photo;
			}
			else
			{
				$days[] = [$photo];
			}
		}

		$this->days = $days;
	}

	protected function _get_photos_recursively($url)
	{
		$request = $this->_request($url);

		if (!isset($request->data))
			var_dump($request);

		$photos = [];
		foreach ($request->data as $raw_photo)
		{
			$photo = new stdClass();
			$photo->time = $raw_photo->created_time;
			$photo->caption = is_object($raw_photo->caption) && property_exists($raw_photo->caption, 'text') ?
					$raw_photo->caption->text : null;
			$photo->link = $raw_photo->link;
			$photo->thumb = $raw_photo->images->thumbnail->url;
			$photos[$photo->time] = $photo;
		}
		if ($request->pagination && property_exists($request->pagination, 'next_url'))
			$photos = $photos + $this->_get_photos_recursively($request->pagination->next_url);
		ksort($photos);
		return $photos;
	}

	protected function _request($url)
	{
		$hash = md5($url);
		$cache_file = lmb_var_dir() . '/pages/import' . $hash;
		if (!file_exists($cache_file))
		{
			$request = new HttpRequest();
			$request->setUrl($url);
			$response = $request->send();
			lmbFs::safeWrite($cache_file, serialize($response));
		}
		$content = isset($response) ? $response : unserialize(file_get_contents($cache_file));
		$body = json_decode($content->getBody());
		return $body;
	}
}
