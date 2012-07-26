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

    $this->main_user->save(); 
		$this->_loginAndSetCookie($this->main_user);

		$this->get('current_day/start');
		$this->assertResponse(405);

		$errors = $this->post('current_day/start')->errors;
		$this->assertResponse(400);
		$this->assertEqual('array', gettype($errors));
		$this->assertTrue(0 < count($errors));
	}

	/**
	 * @api description Starts a day
	 * @api input param string title Title name for this day
	 * @api input param string description Description for this day
	 * @api input param int timezone UTC time zone offset
	 * @api input option string occupation Thing that user are planning to do during current day
	 * @api input param string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
	 * @api result int id Day ID
	 * @api result int user_id
	 * @api result string title
	 * @api result string description
	 * @api result int timezone UTC time zone
	 * @api result string occupation
	 * @api result string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
	 * @api result int likes_count
	 * @api result int ctime Creation time, unix timestamp
	 * @api result int utime Last update time, unix timestamp
	 * @api result boolean is_ended Always FALSE for new days
	 */
	function testStart()
	{
    $this->main_user->save();

		$this->_loginAndSetCookie($this->main_user);

		$params = $this->generator->day()->exportForApi();

		$day = $this->post('current_day/start', $params)->result;
		if($this->assertResponse(200))
    {
      $this->assertEqual($params->title, $day->title);
      $this->assertEqual($this->main_user->getId(), $day->user_id);
      $this->assertEqual($params->timezone, $day->timezone);
      $this->assertEqual($params->occupation, $day->occupation);
      $this->assertTrue($day->ctime);
      $this->assertTrue($day->utime);
    }
	}

  function testStart_withNoOccupation() {

    $this->main_user->setOccupation('testStart_withNoOccupation - user');
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $params = $this->generator->day()->exportForApi();
    $params->occupation = null;

    $day = $this->post('current_day/start', $params)->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual($params->title, $day->title);
      $this->assertEqual($this->main_user->getId(), $day->user_id);
      $this->assertEqual($params->timezone, $day->timezone);
      $this->assertEqual($this->main_user->occupation, $day->occupation);
      $this->assertTrue($day->ctime);
      $this->assertTrue($day->utime);
    }
  }

	/**
	 * @api description Returns current day
	 * @api result int id Day ID
	 * @api result int user_id
	 * @api result string title
	 * @api result string description
	 * @api result int timezone UTC time zone offset
	 * @api result string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
	 * @api result int likes_count
	 * @api result int ctime Creation time, unix timestamp
	 * @api result int utime Last update time, unix timestamp
	 * @api result boolean is_ended TRUE if day is ended, else - FALSE
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

		$this->get('current_day');
		$this->assertResponse(404);
	}

	/**
	 * @api description Creates moment
	 * @api input param string description
	 * @api input param string image_name
	 * @api input param string image_content File contents, that was previously encoded by base64
	 * @api result int id Moment ID
	 * @api result int day_id ID day that moment belongs to
	 * @api result string description Moment description
	 * @api result string img_url URL to file image
	 * @api result int likes_count
	 * @api result int ctime Moment creation time, unix timestamp
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
			$this->assertProperty($res, 'img_url');
			$this->assertEqual(0, $res->likes_count);
			$this->assertProperty($res, 'ctime');
		}
	}

  /**
   * @api input param string title
   * @api input param string description
   * @api input param int timezone
   * @api input param string location
   * @api input param string type
   * @api result int id Day ID
   * @api result int user_id
   * @api result string title
   * @api result string description
   * @api result int timezone UTC time zone offset
   * @api result string occupation
   * @api result string type One of pre-defined types: {working, day-off, holiday, trip, special_event}
   * @api result int likes_count
   * @api result int ctime Creation time, unix timestamp
   * @api result int utime Last update time, unix timestamp
   * @api result boolean is_ended TRUE if day is ended, else - FALSE
   */
  function testUpdate()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);

    $this->post('current_day/update', array(
        'title' => $title = $this->generator->string(),
        'occupation' => $occupation = $this->generator->string(255),
        'timezone' => $timezone = $this->generator->integer(1),
        'location' => $location = $this->generator->string(),
        'type' => $type = 'working'
    ));
    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId());
      $this->assertEqual($loaded_day->getTitle(), $title);
      $this->assertEqual($loaded_day->getOccupation(), $occupation);
      $this->assertEqual($loaded_day->getTimezone(), $timezone);
      $this->assertEqual($loaded_day->getLocation(), $location);
      $this->assertEqual($loaded_day->getType(), $type);
    }
  }

	/**
	 * @api description Finish current day.
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


	/* GET /my/current_day - запрашивается при старте приложения, возвращает текущий наполняемый день пользователя */
}
