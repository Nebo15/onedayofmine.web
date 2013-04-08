<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');

class PagesController extends WebAppController
{
	/**
	 * @var odTools
	 */
	protected $toolkit;
	protected $instagram_api_host = 'https://api.instagram.com';

	function doDayCreate()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();
		return $this->doImport();
	}

	function doDisplay()
	{
		$this->redirect('/');
		return;
	}

	function doDaysDiscover()
	{
		$top_days = array_map(function($day_rating) {
      return $day_rating->getDay();
    }, (array) (new InterestCalculator())->getDaysRatings(null, null, $this->lists_limit));

    $top_days_exported = $this->toolkit->getExportHelper()->exportDayItems($top_days);

		$this->days = [];
		foreach ($top_days_exported as $day)
		{
			$item = $this->_toFlatArray($day);

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

    $this->user = $user;
		$this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays()->paginate(0, $this->lists_limit)));
	}

	function doMyFollowers()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$this->followers = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($user->getFollowersUsers()));
		$this->following = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($user->getFollowingUsers()));
	}

	function doProfile()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();
		return $this->redirect('/pages/'.$user->id.'/user');
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
    if($this->request->has('preview'))
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
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$id = $this->request->get('id');

		$this->moment = Moment::findById($id);
		if (!$this->moment || $this->moment->getDay()->is_deleted)
			return $this->forwardTo404();
	}

	function doImport()
	{
		if($this->_getUser())
		{
			$this->facebook_app_id = $this->toolkit->getConf('facebook')->appId;
			$this->instagram = $this->toolkit->getConf('common')->instagram;
		}
	}

	function doUser()
	{
		if(!$id = $this->request->get('id'))
			return $this->forwardTo404();

		if(!$user = User::findById($id))
			return $this->forwardTo404();

		if($this->_getUser() && $this->_getUser()->id == $id && !$this->request->has('preview'))
		{
			$this->setTemplate('pages/user_owner.phtml');
			return;
		}

		$this->user = (array) $this->toolkit->getExportHelper()->exportUser($user);

		$this->user['days'] = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays()->paginate(0, $this->lists_limit)));
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

	function doLjPreview()
	{
		lmb_require('ljparse/ContentPageParser.class.php');
		lmb_require('ljparse/MobilePageRegexpParser.class.php');
		lmb_require('ljparse/ContentPage.class.php');

		$parts = explode('/', $this->request->get('url'));
		$id = explode('.', array_pop($parts))[0];
		$context  = stream_context_create(['http' => ['timeout' => 120]]);
		$content = file_get_contents('http://m.livejournal.com/read/user/odin_moy_den/'.$id, false, $context);

		$page = new ContentPage(new MobilePageRegexpParser());
		$page->setContent($content);

		$this->is_preview = true;

		$moments = $page->getMoments();
		$this->day = new stdClass;
		$this->day->id = null;
		$this->day->title = $this->title = $page->getTitle();
		$this->day->type = '';
		$this->day->date = date('Y-m-d', strtotime($page->getDate()));
		$this->day->final_description = "It's just a preview";
		$this->day->comments_count = 0;
    $this->day->comments =[];
		$this->day->likes_count = 0;
		$this->day->user = new stdClass;
		$this->day->user->id = '';
		$this->day->user->name = $page->getUsername();
		$this->day->user->image_72 = $page->getUserpic();
		$this->day->moments = [];
		$time = 480;
		$delta = (1440 - 640) / count($moments);
		foreach($moments as $i => $moment_data)
		{
			$time += rand($delta - 5, $delta + 5);
			$moment = new stdClass;
			$moment->id = 1;
			$moment->datetime_iso = 1;
			$moment->time = str_pad(floor($time / 60), 2, '0', STR_PAD_LEFT).":".str_pad($time - floor($time / 60) * 60, 2, '0', STR_PAD_LEFT);
			$moment->image_532 = $moment_data['img'];
			$moment->description = $moment_data['description'];
			$this->day->moments[] = $moment;
		}

		$this->setTemplate('pages/day.phtml');
	}
}
