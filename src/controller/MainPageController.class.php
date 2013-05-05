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
		$days = $this->toolkit->getExportHelper()->exportDayItems(
			DayJournalRecord::findDaysWithLimitation(null, null, $this->lists_limit)
		);
		foreach($days as $i => $day)
			$days[$i]->date = date('Y-m-d', $day->utime);
		$this->days = $this->_toFlatArray($days);
	}
}
