<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class CurrentDayAcceptanceTest extends odAcceptanceTestCase
{
	function setUp()
	{
		parent::setUp();
		odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment');
	}

	/* GET /my/current_day - запрашивается при старте приложения, возвращает текущий наполняемый день пользователя
	POST /my/current_day/start
	POST /my/current_day/addMoment
	POST /my/current_day/finish */
}
