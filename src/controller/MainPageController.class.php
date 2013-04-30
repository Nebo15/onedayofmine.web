<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');

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


}
