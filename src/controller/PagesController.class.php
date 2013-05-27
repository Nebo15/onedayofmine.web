<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('tests/src/odStaticObjectMother.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Moment.class.php');
lmb_require('src/model/DayJournalRecord.class.php');

class PagesController extends WebAppController
{
	/**
	 * @var odTools
	 */
	protected $toolkit;
	protected $instagram_api_host = 'https://api.instagram.com';

	function doNews()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

		$user  = $this->toolkit->getUser();
		$news = $user->getNews()->paginate(0, $this->lists_limit);
		$user->markAllNewsAsRead();

		$this->news = $this->_mergeNews($news);
		$this->news = $this->_toFlatArray($this->news);

		$followers = $this->_getUser()->getFollowersUsers();
		$this->followers = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($followers));

		$following = $this->_getUser()->getFollowingUsers();
		$this->following = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($following));
	}

	protected function _mergeNews($news)
	{
		$news = $this->toolkit->getExportHelper()->exportNewsItems($news, true);

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

		if($current)
			$result[] = $current;

		return $result;
	}

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

	function doMyDays()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();

    $this->user = $user;
		$this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays()->paginate(0, $this->lists_limit)));
	}

	function doPeoples()
	{
		if ($user = lmbToolkit::instance()->getUser())
		{
			$this->followers = $this->_sortUsersByNames($user->getFollowingUsers());
			$this->following = $this->_sortUsersByNames($user->getFollowersUsers());
		}
	}

	protected function _sortUsersByNames($users)
	{
		$users = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($users));
		foreach($users as $i => $user)
			$users[$i]->lower_name = strtolower($user->name);
		return lmbArrayHelper::sortArray($users, ['lower_name' => 'ASC']);
	}

	function doProfile()
	{
		if (!$user = lmbToolkit::instance()->getUser())
			return $this->forwardToUnauthorized();
		return $this->redirect('/pages/'.$user->id.'/user');
	}

	function doDay()
	{
		if (!$day = Day::findById($this->request->get('id')))
			return $this->forwardTo404();

		if ($day->is_deleted)
			return $this->forwardTo404();

    $this->is_preview = false;
    $this->is_owner = false;
    if($this->request->has('preview'))
      $this->is_preview = true;
    else if ($this->_getUser() && ($this->_getUser()->id == $day->user_id || $this->_getUser()->is_editor))
      $this->is_owner = true;

		if (!$this->is_owner && !$this->is_preview)
		{
			$day->views_count = $day->views_count + 1;
			$day->save();
		}

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
		$this->day_obj = $day;
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

    if($this->request->has('id')) {
      $id = $this->request->getFiltered('id', FILTER_SANITIZE_NUMBER_INT);
    } elseif($this->request->has('url')) {
  		$parts = explode('/', $this->request->get('url'));
  		$id = (int) explode('.', array_pop($parts))[0];
    } else {
      return $this->forwardTo404();
    }

		$context  = stream_context_create(['http' => ['timeout' => 120]]);
		$content = file_get_contents('http://m.livejournal.com/read/user/odin_moy_den/'.$id, false, $context);

		$page = new ContentPage(new MobilePageRegexpParser());
		$page->setContent($content);

		$this->is_import_preview = true;

    $this->import_from = 'http://odin-moy-den.livejournal.com/'.$id.'.html';

		$moments = $page->getMoments();
		$this->day_obj = new Day();
		$this->day = new stdClass;
    $this->day->is_template = true;
		$this->day->id = null;
		$this->day->title = $this->title = $page->getTitle();
		$this->day->type = 'Working day';
		$this->day->date = date('Y-m-d', strtotime($page->getDate()));
		$this->day->final_description = "It's just a preview!";
		$this->day->comments_count = 0;
    $this->day->comments =[];
    $this->day->likes_count = '∞';
    $this->day->likes = [];
    $this->day->views_count = 1;
    $this->day->image_532 = '';
    $this->day->image_266 = '';
    if($this->toolkit->getUser()) {
      $this->day->user = $this->toolkit->getExportHelper()->exportUserItem($this->toolkit->getUser());
    } else {
  		$this->day->user = new stdClass;
  		$this->day->user->id = $this->toolkit->getUser() ? $this->toolkit->getUser()->id : '';
  		$this->day->user->name = $page->getUsername();
  		$this->day->user->image_72 = $page->getUserpic();
    }
		$this->day->moments = [];
		$time = 480;
		$delta = (1440 - 640) / count($moments);

    $lj_image_sizes = [
      '1000',
      '900',
      '640'
    ];

		foreach($moments as $i => $moment_data)
		{
      $parts = explode('/', $moment_data['img']);
      $last = array_pop($parts);
      $image_link = implode('/', $parts); // http://ic.pics.livejournal.com/vika_ntessa/10278374/62536/

      list($file, $ext) = explode('.', $last);
      list($img_id, $size) = explode('_', $file);

      $biggest_image = $moment_data['img'];
      foreach ($lj_image_sizes as $size) {
        $tmp = "{$image_link}/{$img_id}_{$size}.{$ext}";
        if($this->_removeFileExits($tmp)) {
          $biggest_image = $tmp;
          break;
        }
      }

      if($this->day->image_532 == '') {
        $this->day->image_532 = $biggest_image;
        $this->day->image_266 = $biggest_image;
      }

			$time += rand($delta - 5, $delta + 5);
			$moment = new stdClass;
			$moment->id = 1;
			$moment->datetime_iso = 1;
			$moment->time = str_pad(floor($time / 60), 2, '0', STR_PAD_LEFT).":".str_pad($time - floor($time / 60) * 60, 2, '0', STR_PAD_LEFT);
      $moment->image_532 = $biggest_image;
			$moment->image_266 = $biggest_image;
			$moment->description = $moment_data['description'];
			$this->day->moments[] = $moment;
		}

		$this->setTemplate('pages/day.phtml');
	}

  function _removeFileExits($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $retcode == 200;
  }

	function doDiaryPreview()
	{
		lmb_require('ljparse/ContentPageParser.class.php');
		lmb_require('ljparse/DiaryMobilePageRegexpParser.class.php');
		lmb_require('ljparse/DiaryContentPage.class.php');

    if($this->request->has('id')) {
      $id = $this->request->getFiltered('id', FILTER_SANITIZE_NUMBER_INT);
    } elseif($this->request->has('url')) {
  		$parts = explode('/', $this->request->get('url'));
  		$id = explode('.', array_pop($parts))[0];
    } else {
      return $this->forwardTo404();
    }

		$context  = stream_context_create(['http' => ['timeout' => 120]]);
		$content = file_get_contents('http://m.diary.ru/~adiml/'.$id.'.htm?oam#more1', false, $context);
    $this->import_from = 'http://diary.ru/~adiml/'.$id.'.htm?oam#more1';

		$page = new DiaryContentPage(new DiaryMobilePageRegexpParser());
		$page->setContent($content);

		$this->is_import_preview = true;

		$moments = $page->getMoments();
		$this->day_obj = new Day();
		$this->day = new stdClass;
    $this->day->is_template = true;
		$this->day->id = null;
		$this->day->title = $this->title = $page->getTitle();
		$this->day->type = 'Working day';
		$this->day->date = date('Y-m-d', strtotime($page->getDate()));
		$this->day->final_description = "It's just a preview!";
		$this->day->comments_count = 0;
		$this->day->comments =[];
    $this->day->likes_count = '∞';
    $this->day->likes = [];
    $this->day->views_count = 1;
    $this->day->image_532 = '';
    $this->day->image_266 = '';
    if($this->toolkit->getUser()) {
      $this->day->user = $this->toolkit->getExportHelper()->exportUserItem($this->toolkit->getUser());
    } else {
      $this->day->user = new stdClass;
      $this->day->user->id = $this->toolkit->getUser() ? $this->toolkit->getUser()->id : '';
      $this->day->user->name = $page->getUsername();
      $this->day->user->image_72 = $page->getUserpic();
    }
		$this->day->moments = [];
		$time = 480;
		$delta = (1440 - 640) / count($moments);
		foreach($moments as $i => $moment_data)
		{
      if($this->day->image_532 == '') {
        $this->day->image_532 = $moment_data['img'];
        $this->day->image_266 = $moment_data['img'];
      }

			$time += rand($delta - 5, $delta + 5);
			$moment = new stdClass;
			$moment->id = 1;
			$moment->datetime_iso = 1;
			$moment->time = str_pad(floor($time / 60), 2, '0', STR_PAD_LEFT).":".str_pad($time - floor($time / 60) * 60, 2, '0', STR_PAD_LEFT);
      $moment->image_266 = $moment_data['img'];
			$moment->image_532 = $moment_data['img'];
			$moment->description = iconv('cp1251', 'utf-8', $moment_data['description']);
			$this->day->moments[] = $moment;
		}

    $this->setTemplate('pages/day.phtml');
  }

  function doJournal()
  {
    $days_ratings = (new InterestCalculator())->getDaysRatings(null, null, $this->lists_limit);

    $days = [];
    foreach ($days_ratings as $day_rating)
      $days[$day_rating->day_id] = $day_rating->getDay();

    $this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($days));

    foreach ($this->days as $id => $day) {
      $day->date = date('Y-m-d', $day->utime);

      $day->final_description = $days[$day->id]->final_description;
    }
  }

  function doDaysDiscover()
  {
    $days_ratings = (new InterestCalculator())->getDaysRatings(null, null, $this->lists_limit);

    $days = [];
    foreach ($days_ratings as $day_rating)
      $days[] = $day_rating->getDay();

    $this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($days));
  }
}
