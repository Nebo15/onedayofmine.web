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

		$this->days = $this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays());
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

    $this->is_owner = false;
    if ($this->toolkit->getUser() && $this->toolkit->getUser()->id == $day->user_id)
      $this->is_owner = true;

    $this->day = $this->toolkit->getExportHelper()->exportDay($day);

    $this->day->utime = date('m/d/y', $this->day->utime);
    $this->day->ctime = date('m/d/y', $this->day->ctime);

    foreach ($this->day->moments as $moment) {
      $time = strtotime($moment->time);

      $moment->time = date('h:i', $time);
      $moment->time_seconds = date('s', $time);
      $moment->date = date('Y-m-d', $time);
      $moment->timezone = date('P', $time);

      $moment->datetime_w3c = date(DATE_W3C, $time);
      $moment->datetime_iso = date(DATE_ISO8601, $time);
    }

    $this->current_user = $this->toolkit->getUser();
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
		$this->user['days'] = (array) $this->toolkit->getExportHelper()->exportDayItems($user->getPublicDays());
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
		return json_decode(json_encode($object), true);
	}
}
