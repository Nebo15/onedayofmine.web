<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('src/controller/DaysController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/DayJournalRecord.class.php');

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
		$days = DayJournalRecord::findDaysWithLimitation(null, null, $this->lists_limit);

    if(count($days) > 0) {
  		$this->featured_day = $this->toolkit->getExportHelper()->exportDay(array_shift($days));
      $this->journal_days = $this->_formatDaysForJournal($days);
    } else {
      $this->journal_days = [];
    }

		$popular_days_ratings = (new InterestCalculator())->getDaysRatings(null, null, 3);
		$popular_days = Day::findByIds(lmbArrayHelper::getColumnValues('day_id', $popular_days_ratings));
		$this->popular_days = $this->_formatDaysForJournal($popular_days);

		$new_days = Day::findNew(null, null, 1);
		$this->new_days = $this->_formatDaysForJournal($new_days);

		$this->new_users_objs = User::find()->paginate(0, 6);
		$this->new_users = $this->_toFlatArray($this->toolkit->getExportHelper()->exportUserItems($this->new_users_objs));
	}

	function _formatDaysForJournal($raw_days)
	{
		$days = $this->toolkit->getExportHelper()->exportDayItems($raw_days);
		foreach($days as $i => $day)
			$days[$i]->date = date('Y-m-d', $day->utime);

		return $this->_toFlatArray($days);
	}
}
