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
			$featured_day = $this->_formatFeaturedDay(count($featured_day_raw) ? $featured_day_raw[0] : new Day());
			$cache->set('main_page_featured_day', $featured_day, 600);
		}
		$this->featured_day = $featured_day;

		$journal_days_limit = 8;
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
		$this->view->set('top', $popular_days_data);

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
			Day::TYPE_WORKING => null,
			Day::TYPE_DAYOFF => null,
			Day::TYPE_HOLIDAY => null,
			Day::TYPE_TRIP => null,
			'popular_days' => []
		];
		$popular_days_ratings = (new InterestCalculator())->getDaysRatings();
		$popular_days = Day::findByIds(lmbArrayHelper::getColumnValues('day_id', $popular_days_ratings));
		foreach($popular_days as $day)
		{
			if(is_null($result[$day->type]))
				$result[$day->type] = $this->_formatDaysForJournal($day);
			elseif(count($result['popular_days']) < 3)
				$result['popular_days'][] = $this->_formatDaysForJournal($day);
		}

		return $result;
	}

  protected function _formatDaysForJournal($days_or_day)
  {
	  if(is_array($days_or_day) || (is_object($days_or_day) && $days_or_day instanceof lmbCollectionInterface))
		  $days_or_day = $this->toolkit->getExportHelper()->exportDayItems($days_or_day);
	  else
		  $days_or_day = $this->toolkit->getExportHelper()->exportDay($days_or_day);
    $flat = $this->_toFlatArray($days_or_day);
	  return $flat;
  }

  protected function _formatFeaturedDay($featured_day)
  {
    $featured_day = $this->_formatDaysForJournal($featured_day);

    foreach ($featured_day->moments as $index => $moment) {
      if($moment['image_266'] == $featured_day['image_266']) {
        unset($featured_day->moments[$index]);
      }
    }

	  if(count($featured_day->moments) >= 8)
	  {
		  $moments = array_slice($featured_day->moments, 2, -1);
		  $moments_chunks = array_slice(array_chunk($moments, count($moments) / 5), 0, 5);
	  }
	  else
		  $moments_chunks = array_slice(array_chunk($featured_day->moments, 1), 0, 5);

	  $featured_day->top_moments = [];
	  foreach($moments_chunks as $chunk)
			$featured_day->top_moments[] = $chunk[0];

    return $featured_day;
  }
}
