<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('src/controller/DaysController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/DayJournalRecord.class.php');
lmb_require('src/model/Day.class.php');

class MainPageController extends WebAppController
{
	function doDeploy()
	{
		if (extension_loaded('newrelic'))
			newrelic_ignore_transaction();
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
		$cache = $this->toolkit->getCache();
		$view = [];

		if(!$journal_data = $cache->get('main_page_journal_days'))
		{
			$journal_data = $this->_getJournalDaysData();
			$cache->set('main_page_journal_days', $journal_data, 600);
		}
		$this->view->addVariables($journal_data);

		if(!$popular_days_data = $cache->get('main_page_popular_days'))
		{
			$popular_days_data = $this->_getPopularDaysData();
			$cache->set('main_page_popular_days', $popular_days_data, 600);
		}
		$this->view->addVariables($popular_days_data);

		if(!$this->new_days = $cache->get('main_page_new_days'))
		{
			$this->new_days = $this->_formatDaysForJournal(Day::findNew(null, null, 12));
			$cache->set('main_page_new_days', $this->new_days, 600);
		}

		if(!$this->new_users = $cache->get('main_page_new_users'))
		{
			$new_users_objs = User::findNew()->paginate(0, 6);
			$this->new_users = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($new_users_objs));
			$cache->set('main_page_new_users', $this->new_users, 600);
		}

	}

	protected function _getJournalDaysData()
	{
		$result = [];
		$journal_days = DayJournalRecord::findDaysWithLimitation(null, null, 6);
		if(count($journal_days) > 0) {
			$result['featured_day'] = $this->_formatFeaturedDay(array_shift($journal_days));
			$result['journal_days'] = $this->_formatDaysForJournal($journal_days);
		} else {
			$result['featured_day'] = $this->_formatDaysForJournal(new Day());
			$result['journal_days'] = [];
		}

		return $result;
	}

	protected function _getPopularDaysData()
	{
		$export_helper = $this->toolkit->getExportHelper();
		$result = [
			'top_working' => null,
			'top_dayoff' => null,
			'top_holiday' => null,
			'top_trip' => null,
		];
		$popular_days_ratings = (new InterestCalculator())->getDaysRatings();
		$popular_days = Day::findByIds(lmbArrayHelper::getColumnValues('day_id', $popular_days_ratings));
		foreach($popular_days as $day)
		{
			if(!$result['top_working'] && $day->type == Day::TYPE_WORKING)
				$result['top_working'] = $this->_formatDaysForJournal($day);
			if(!$result['top_dayoff'] && $day->type == Day::TYPE_DAYOFF)
				$result['top_dayoff'] = $this->_formatDaysForJournal($day);
			if(!$result['top_holiday'] && $day->type == Day::TYPE_HOLIDAY)
				$result['top_holiday'] = $this->_formatDaysForJournal($day);
			if(!$result['top_trip'] && $day->type == Day::TYPE_TRIP)
				$result['top_trip'] = $this->_formatDaysForJournal($day);
		}

		$popular_days->paginate(0, 12);
		$result['popular_days'] = $this->_formatDaysForJournal($popular_days);

		return $result;
	}

  protected function _formatDaysForJournal($days_or_day)
  {
	  if(is_array($days_or_day) || (is_object($days_or_day) && $days_or_day instanceof lmbCollectionInterface))
		  $days_or_day = $this->toolkit->getExportHelper()->exportDayItems($days_or_day);
	  else
		  $days_or_day = $this->toolkit->getExportHelper()->exportDay($days_or_day);
    return $this->_toFlatArray($days_or_day);
  }

  protected function _formatFeaturedDay($featured_day) {
    $featured_day = $this->_formatDaysForJournal($featured_day);

    foreach ($featured_day->moments as $index => $moment) {
      if($moment['image_266'] == $featured_day['image_266']) {
        unset($featured_day->moments[$index]);
      }
    }

    $featured_day->moments = array_slice($featured_day->moments, 0, 3);

    return $featured_day;
  }
}
