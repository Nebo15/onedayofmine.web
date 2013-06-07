<?php
lmb_require('src/controller/WebAppController.class.php');
lmb_require('src/controller/DaysController.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');
lmb_require('src/model/DayJournalRecord.class.php');
lmb_require('src/model/Day.class.php');

class RssController extends WebAppController
{
	function doJournal()
	{
		$this->response->addHeader('Content-Type: application/rss+xml; charset=utf-8');
		$this->build_time = date('r');
		$this->items = DayJournalRecord::findDaysWithLimitation(null, null, 20);
	}
}
