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
		$this->assertResponse(401);

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
	 * @api description Starts a day, returns created <a href="#Entity:Day">day</a>.
	 * @api input param string title
	 * @api input param int timezone UTC time zone offset
   * @api input option string occupation If omited, then user profile occupation will be used
	 * @api input option string latlong "[Latitude],[Longitude]" of place, where day was created
	 * @api input param string type One of pre-defined types, see: GET day/type_names request
	 */
	function testStart()
	{
    $this->main_user->save();

		$this->_loginAndSetCookie($this->main_user);

		$params = $this->generator->day()->exportForApi();

		$day = $this->post('current_day/start', array(
      'title' => $params->title,
      'timezone' => $params->timezone,
      // 'latlong' => $params->latlong,
      'occupation' => $params->occupation,
      'type' => $params->type,
    ))->result;
		if($this->assertResponse(200))
    {
      $this->assertEqual($params->title, $day->title);
      $this->assertEqual($params->timezone, $day->timezone);
      $this->assertEqual($params->occupation, $day->occupation);
      // $this->assertEqual($params->latlong, $day->latlong);
      $this->assertEqual($params->type, $day->type);
      $this->assertEqual($this->main_user->getId(), $day->user_id);
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

  // TODO
  function testStart_withAlreadyStartedDay()
  {

  }

	/**
	 * @api description Returns current <a href="#Entity:Day">day</a>. Additional fields are listed below.
   * @api result Moment[3] moments Array of day moments
   * @api result int comments_count Count of comments to this day
   * @api result Comment[3] comments Array of day first comments
   * @api result bool is_favorited True if this article is added to current user favourites. If user is not logged in then field is omited.
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
	 * @api description Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.
	 * @api input param string description
	 * @api input param string image_name Requires image_content field.
	 * @api input param string image_content File contents, that was previously encoded by base64
   * @api input option int image_shoot_time Unix timestamp of time, when picture was created. If omited, current timestamp will be used.
	 */
	function testCreateMoment()
	{
		$day = $this->generator->day($this->main_user);
		$day->setIsEnded(0);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$res = $this->post('current_day/moment_create', array(
				'description' => $description = $this->generator->string(200),
				'image_name' => $image_path = $this->generator->image_name(),
				'image_content' => base64_encode($this->generator->image()),
        'image_shoot_time' => $image_shoot_time = $this->generator->integer(6)
		))->result;

		if($this->assertResponse(200))
		{
			$this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
			$this->assertEqual($day->getId(), $res->day_id);
			$this->assertProperty($res, 'image_small');
      $this->assertProperty($res, 'image_big');
			$this->assertEqual(0, $res->likes_count);
			$this->assertProperty($res, 'ctime');
      $this->assertEqual($res->image_shoot_time, $image_shoot_time);
		}
	}

  function testCreateMoment_CoverOnFirstMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('current_day/moment_create', array(
      'description' => $description = $this->generator->string(200),
      'image_name' => $image_path = $this->generator->image_name(),
      'image_content' => base64_encode($this->generator->image())
    ))->result;

    $loaded_day = Day::findById($day->getId())->exportForApi();
    $img = @file_get_contents($loaded_day->cover_image_small);
    $this->assertTrue($img, "Cover image {$loaded_day->cover_image_small} not found");
  }

  /**
   * @api description Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.
   * @api input option string title
   * @api input option int timezone UTC time zone offset
   * @api input option string occupation Can be omited, then user profile occupation will be used
   * @api input option string latlong "[Latitude],[Longitude]" of place, where day was created
   * @api input option string type One of pre-defined types, see: GET day/type_names request
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
}
