<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends lmbController
{
	/**
	 * @var odTools
	 */
	protected $toolkit;
	protected $instagram_api_host = 'https://api.instagram.com';

	function doDayCreate()
	{
		return $this->doImport();
	}

	function doDisplay()
	{
		if($this->toolkit->getUser())
		{
			$user  = $this->toolkit->getUser();
			$news = $user->getNews();

			$this->news = $this->_mergeNews($news);

			foreach($this->news as $i => $news_item)
			{
				$search = ['/odom:\/\/users\/(\d+)/', '/odom:\/\/days\/(\d+)/'];
				$replace = ['/pages/$1/user', '/pages/$1/day'];
				$this->news[$i]->text = preg_replace($search, $replace, $news_item->text);
			}

			$this->news = $this->_toFlatArray($this->news);

			$followers = $this->_getUser()->getFollowersUsers();
			$this->followers = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($followers));

			$following = $this->_getUser()->getFollowingUsers();
			$this->following = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($following));

			return $this->doImport();
		}
		else
		{
			$this->setTemplate('pages/display_guest.phtml');
		}
	}

	protected function _mergeNews($news)
	{
		$news = $this->toolkit->getExportHelper()->exportNewsItems($news);

		$result = [];
		$current = null;
		foreach($news as $news_item)
		{
			if($current && $current->text == $news_item->text)
			{
				if(property_exists($news_item, 'day') && $current->day != $news_item->day)
					$current->days[] = $news_item->day;
				if(property_exists($news_item, 'moment') && $current->moment != $news_item->moment)
					$current->moments[] = $news_item->moment;
				if(property_exists($news_item, 'day_comment') && $current->day_comment != $news_item->day_comment)
					$current->day_comments[] = $news_item->day_comment;
				if(property_exists($news_item, 'moment_comment') && $current->moment_comment != $news_item->moment_comment)
					$current->moments_comments[] = $news_item->moment_comment;
			}
			else
			{
				if($current)
					$result[] = $current;
				$current = $news_item;
				$current->days = $current->moments = $current->day_comments = $current->moment_comments = [];
			}
		}

		return $result;
	}

	function doDaysDiscover()
	{
		$days_ratings = (new InterestCalculator())->getDaysRatings();

		$this->days = [];
		foreach ($days_ratings as $day_rating)
		{
			$item = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDay($day_rating->getDay()));
			if(!$item['image_532'])
				continue;
			if(!$item['image_266'])
				continue;
			$this->days[] = $item;
		}
	}

	function doMyDays()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays()));
	}

	function doMyFollowers()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$this->followers = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($user->getFollowersUsers()));
		$this->following = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($user->getFollowingUsers()));
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

    $this->is_preview = false;
    $this->is_owner = false;
    if($this->request->has('previev'))
      $this->is_preview = true;
    else if ($this->toolkit->getUser() && $this->toolkit->getUser()->id == $day->user_id)
      $this->is_owner = true;

    $this->day = $this->toolkit->getExportHelper()->exportDay($day);

    $this->day->utime = date('Y-m-d', $this->day->utime);
    $this->day->ctime = date('Y-m-d', $this->day->ctime);

    $min_timestamp = time();
    foreach ($this->day->moments as $moment) {
      $time = strtotime($moment->time);

      if($min_timestamp > $time)
        $min_timestamp = $time;

			$moment->time = date('H:i', $time);
      $moment->time_seconds = date('s', $time);
      $moment->date = date('Y-m-d', $time);
      $moment->timezone = date('P', $time);

      $moment->datetime_w3c = date(DATE_W3C, $time);
      $moment->datetime_iso = date(DATE_ISO8601, $time);
    }

    $this->day->date = date('Y-m-d', $min_timestamp);

		$this->day = $this->_toFlatArray($this->day);

	}

	function doMoment()
	{
		$id = $this->request->get('id');

		$this->moment = Moment::findById($id);
		if (!$this->moment || $this->moment->getDay()->is_deleted)
			return $this->forwardTo404();
	}

	function doImport()
	{
		$this->facebook_app_id = $this->toolkit->getConf('facebook')->appId;
		$this->instagram = $this->toolkit->getConf('common')->instagram;
	}

	function doUser()
	{
		if(!$id = $this->request->get('id'))
			return $this->forwardTo404();

		if(!$user = User::findById($id))
			return $this->forwardTo404();

		$this->user = (array) $this->toolkit->getExportHelper()->exportUser($user);

		$this->user['days'] = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays()));
		$followers = $user->getFollowersUsers();
		$this->user['users_followers'] = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($followers));

		$following = $user->getFollowingUsers();
		$this->user['users_following'] = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($following));

    $this->user['comments_count'] = $user->getDaysComments()->count();
	}

	function doFlickr()
	{
		if(!$this->_getUser())
			return $this->forwardToUnauthorized();
		$flickr = $this->toolkit->getFlickr();
		if(false && !$this->_getUser()->flickr_token || !$flickr->auth_checkToken($this->_getUser()->flickr_token))
		{
			if(1 == $this->request->get('step', 1))
			{
				$url = $flickr->auth_build_url('read', false);
				return $this->redirect($url);
			}
			else
				$this->_connectToFlickr();
		}

		$flickr->setToken($this->_getUser()->flickr_token);
		$photos = $flickr->photos_search([
			'user_id' => $this->_getUser()->flickr_uid,
			'extras' => 'description,geo,date_taken,media,url_l'
		])['photo'];
		$response = [];
		foreach($photos as $photo)
		{
			if(!array_key_exists('url_l', $photo) || 'photo' != $photo['media'] || 'ready' != $photo['media_status'])
				continue;
			$response[] = [
				'flickr_id' => $photo['id'],
				'title' => $photo['title'],
				'image' => $photo['url_l'],
				'description' => $photo['description'],
				'location_latitude' => $photo['latitude'],
				'location_longitude' => $photo['longitude'],
			];
		}
		return json_encode($response);
	}

	function _connectToFlickr()
	{
		$flickr = $this->toolkit->getFlickr();
		$response = $flickr->auth_getToken($this->request->get('frob'));
		if(!$response)
			return $this->redirect('/pages/flickr');
		$user = $this->_getUser();
		$user->flickr_uid = $response['user']['nsid'];
		$user->flickr_token = $response['token'];
		$user->save();

		lmbToolkit::instance()->setUser($user);
	}

	function doNotFound()
	{
		$this->response->setCode(404);
	}

	function forwardTo404()
	{
		$this->response->setCode(404);
		$this->setTemplate('pages/not_found.phtml');
	}

	function forwardToUnauthorized()
	{
		$this->response->setCode(401);
		$this->setTemplate('pages/not_authorized.phtml');
	}

	function performAction()
	{
		$this->current_user = $this->toolkit->getUser()
				? (array) $this->toolkit->getExportHelper()->exportUser($this->toolkit->getUser())
				: new stdClass;
		return parent::performAction();
	}

	protected function _getUser()
	{
		return $this->toolkit->getUser();
	}

	protected function _toFlatArray($object)
	{
		if(is_object($object))
		{
			$res = new lmbSet();
			foreach((array) $object as $name => $value)
				$res->$name = $this->_toFlatArray($value);
			return $res;
		}
		elseif(is_array($object))
		{
			$res = [];
			foreach($object as $key => $one_value)
				$res[$key] = $this->_toFlatArray($one_value);
			return $res;
		}
		else
		{
			return $object;
		}
	}
}
