<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');

class MainPageController extends WebAppController
{
	function doDeploy()
	{
		if('production' == lmb_app_mode())
			return $this->forwardTo404();
		echo '<pre>';
		system(lmb_env_get('APP_DIR').'/cli/update.sh');
		die();
	}

  function doNoop()
  {
    return $this->_answerOk();
  }

	function doDisplay()
	{
		if($this->toolkit->getUser())
		{
			$user  = $this->toolkit->getUser();
			$news = $user->getNews(); //->paginate(0, $this->lists_limit);

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

			return;
		}
		else
		{
			$ratings = (new InterestCalculator())->getDaysRatings(null, null, $this->lists_limit);

			$top_days = array_map(function($day_rating) {
				return $day_rating->getDay();
			}, $ratings);

			$this->interesting_days = [];
			foreach ($top_days as $day)
			{
				if($day->is_deleted)
					continue;

				$item = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDay($day));

				if(!$item['image_532'])
					continue;
				if(!$item['image_266'])
					continue;
				if(count($item->moments) < 7)
					continue;

				$item->moments = array_slice($item->moments, 0, 7);

				$item['final_description'] = $day->final_description;
				if(!$item['final_description'])
					continue;

				$this->interesting_days[] = $item;
			}

			$this->setTemplate('main_page/display_guest.phtml');
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
}
