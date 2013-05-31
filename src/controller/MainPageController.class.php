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

		if(!$featured_day = $cache->get('main_page_featured_day'))
		{
			$featured_day_raw = DayJournalRecord::findDaysWithLimitation(null, null, 1);
			$featured_day = $this->_formatDaysForJournal(count($featured_day_raw) ? $featured_day_raw[0] : new Day() );
			$cache->set('main_page_featured_day', $featured_day, 600);
		}
		$this->view->set('featured_day', $featured_day);

		$journal_days_limit = 2;
		$from = (int) $this->request->get('from', $featured_day['id']);
		if(!$journal_days = $cache->get('main_page_journal_days_'.$from))
		{
			$journal_days = $this->_formatDaysForJournal(
				DayJournalRecord::findDaysWithLimitation($from, null, $journal_days_limit)
			);
			$cache->set('main_page_journal_days_'.$from, $journal_days, 600);
		}
		$this->view->set('journal_days', $journal_days);

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

		$this->first_link = $this->request->has('from');
		if(count($journal_days) == $journal_days_limit)
			$this->view->set('next_link', '/?from='.($journal_days[count($journal_days) - 1]->id));
		else
			$this->view->set('next_link', null);

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

		$popular_days->paginate(0, 3);
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

    $featured_day->moments = array_slice($featured_day->moments, 0, 4);

    return $featured_day;
  }
}
