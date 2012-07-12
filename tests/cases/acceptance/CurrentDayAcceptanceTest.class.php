<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class CurrentDayAcceptanceTest extends odAcceptanceTestCase
{
	function setUp()
	{
		parent::setUp();
		odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment');
	}

	function testStart_Negative()
	{
		$this->post('current_day/start');
		$this->assertResponse(400);

		$this->_loginAndSetCookie($this->main_user);

		$this->get('current_day/start');
		$this->assertResponse(405);

		$errors = $this->post('current_day/start')->errors;
		$this->assertResponse(400);
		$this->assertEqual('array', gettype($errors));
		$this->assertTrue(0 < count($errors));
	}

	/**
	 *@public
	 */
	function testStart()
	{
		$this->_loginAndSetCookie($this->main_user);

		$user = User::findOne();

		$params = $this->generator->day()->exportForApi();

		$day = $this->post('current_day/start', $params)->result;
		$this->assertResponse(200);
		$this->assertEqual($params->title, $day->title);
		$this->assertEqual($params->description, $day->description);
		$this->assertEqual($user->getId(), $day->user_id);
		$this->assertEqual($params->timezone, $day->timezone);
		$this->assertTrue($day->ctime);
		$this->assertTrue($day->utime);
	}

	/**
	 *@public
	 */
	function testGetCurrentDay()
	{
		$day = $this->generator->day($this->main_user);
		$day->setIsEnded(0);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$loaded_day = $this->get('current_day')->result;

		$this->assertResponse(200);
		$this->assertEqual($loaded_day->title, $day->title);
		$this->assertEqual($loaded_day->description, $day->description);
		$this->assertEqual($this->main_user->getId(), $day->user_id);
		$this->assertEqual($loaded_day->timezone, $day->timezone);
		$this->assertEqual($loaded_day->ctime, $day->ctime);
		$this->assertEqual($loaded_day->utime, $day->utime);
	}

	function testGetCurrentDay_WithoutUnfinishedDay()
	{
		$day = $this->generator->day($this->main_user);
		$day->setIsEnded(1);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$loaded_day = $this->get('current_day')->result;

		$this->assertResponse(404);
	}

	/**
	 *@public
	 */
	function testCreateMoment()
	{
		$day = $this->generator->day($this->main_user);
		$day->setIsEnded(0);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$res = $this->post('current_day/moment_create', array(
				'description' => $description = $this->generator->string(200),
				'image_name' => $image_path = 'foo/bar/example.png',
				'image_content' => 'iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc/YPAAAAAElFTkSuQmCC'
		))->result;

		if($this->assertResponse(200))
		{
			$this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
			$this->assertEqual($day->getId(), $res->day_id);
			$this->assertEqual($description, $res->description);
			$this->assertProperty($res, 'img_url');
			$this->assertEqual(0, $res->likes_count);
			$this->assertProperty($res, 'ctime');
		}
	}

	/**
	 *@public
	 */
	function testFinish()
	{
		$day = $this->generator->day($this->main_user);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$this->post('current_day/finish')->result;

		$this->assertResponse(200);
	}

	//TODO
	function testEnd_NotFound() {}

	//TODO
	function testUpdate()
	{

	}


	/* GET /my/current_day - запрашивается при старте приложения, возвращает текущий наполняемый день пользователя */
}
