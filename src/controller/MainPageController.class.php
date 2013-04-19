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
			$news = $user->getNews()->paginate(0, $this->lists_limit);

			$this->news = $this->_mergeNews($news);

			$this->news = $this->_toFlatArray($this->news);

			$followers = $this->_getUser()->getFollowersUsers();
			$this->followers = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($followers));

			$following = $this->_getUser()->getFollowingUsers();
			$this->following = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($following));

			return;
		}
		else
		{
			$this->setTemplate('main_page/display_guest.phtml');
		}
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
}
