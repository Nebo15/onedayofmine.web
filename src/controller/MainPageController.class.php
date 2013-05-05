<?php
lmb_require('src/controller/WebAppController.class.php');
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
    $days_journal = DayJournalRecord::find()->paginate(0, $this->lists_limit);

    $days = [];
    $days_by_id = [];
    foreach ($days_journal as $journal_record) {
      $days_by_id[$journal_record->day_id] = $days[] = $journal_record->getDay();
    }

    $this->days = $this->_toFlatArray($this->toolkit->getExportHelper()->exportDayItems($days));

    foreach ($this->days as $id => $day) {
      $day->date = date('Y-m-d', $day->utime);
      $day->final_description = $days_by_id[$day->id]->final_description;
    }
	}
}
