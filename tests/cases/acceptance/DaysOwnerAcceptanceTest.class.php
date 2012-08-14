<?php
lmb_require('tests/cases/acceptance/odAcceptanceTestCase.class.php');

class DaysOwnerAcceptanceTest extends odAcceptanceTestCase
{
	function setUp()
	{
		parent::setUp();
		odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment');
	}

	function testStart_Negative()
	{
		$this->post('days/start');
		$this->assertResponse(401);

    $this->main_user->save();
		$this->_loginAndSetCookie($this->main_user);

		$this->get('days/start');
		$this->assertResponse(405);

		$errors = $this->post('days/start')->errors;
		$this->assertResponse(400);
		$this->assertEqual('array', gettype($errors));
		$this->assertTrue(0 < count($errors));
	}

	/**
	 * @api description Starts a day, returns created <a href="#Entity:Day">day</a>.
	 * @api input param string title
   * @api input option string occupation If omited, then user profile occupation will be used
   * @api input option string location If omited, then user profile occupation will be used
	 * @api input param string type One of pre-defined types, see: GET day/type_names request
	 */
	function testStart()
	{
    $this->main_user->save();

		$this->_loginAndSetCookie($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();

		$response = $this->post('days/start', array(
      'title' => $params->title,
      'location' => $params->location,
      'occupation' => $params->occupation,
      'type' => $params->type,
    ));
		if($this->assertResponse(200))
    {
      if($this->assertProperty($response->result, 'user'))
        $this->assertValidUserJson($day->getUser(), $response->result->user);
      $this->assertEqual($day->title, $response->result->title);
      $this->assertEqual($day->occupation, $response->result->occupation);
      $this->assertEqual($day->location, $response->result->location);
      $this->assertEqual($day->type, $response->result->type);
      $this->assertEqual(0, $response->result->likes_count);
      $this->assertEqual(0, $response->result->is_ended);
    }
	}

  function testStart_withNoOccupation() {

    $this->main_user->setOccupation('testStart_withNoOccupation - user');
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();
    $params->occupation = null;

    $response = $this->post('days/start', array(
      'title' => $params->title,
      'location' => $params->location,
      'occupation' => $params->occupation,
      'type' => $params->type,
    ));
    if($this->assertResponse(200))
    {
      if($this->assertProperty($response->result, 'user'))
        $this->assertValidUserJson($day->getUser(), $response->result->user);
      $this->assertEqual($day->title, $response->result->title);
      $this->assertEqual($this->main_user->occupation, $response->result->occupation);
      $this->assertEqual($day->location, $response->result->location);
      $this->assertEqual($day->type, $response->result->type);
      $this->assertEqual(0, $response->result->likes_count);
      $this->assertEqual(0, $response->result->is_ended);
    }
  }

  function testStart_withNoLocation() {

    $this->main_user->setLocation('testStart_withNoLocation - user');
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();
    $params->location = null;

    $response = $this->post('days/start', array(
      'title' => $params->title,
      'occupation' => $params->occupation,
      'type' => $params->type,
    ));
    if($this->assertResponse(200))
    {
      if($this->assertProperty($response->result, 'user'))
        $this->assertValidUserJson($day->getUser(), $response->result->user);
      $this->assertEqual($day->title, $response->result->title);
      $this->assertEqual($day->occupation, $response->result->occupation);
      $this->assertEqual($this->main_user->location, $response->result->location);
      $this->assertEqual($day->type, $response->result->type);
      $this->assertEqual(0, $response->result->likes_count);
      $this->assertEqual(0, $response->result->is_ended);
    }
  }

  // TODO
  function testStart_withAlreadyStartedDay()
  {

  }

	/**
	 * @api description Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.
	 * @api input param string description
	 * @api input param string image_content File contents, that was previously encoded by base64
   * @api input option time ISO time of moment, when image was created
	 */
	function testCreateMoment()
	{
		$day = $this->generator->day($this->main_user);
		$day->setIsEnded(0);
		$day->save();

		$this->_loginAndSetCookie($this->main_user);
		$res = $this->post('days/'.$day->getId().'/moment_create', array(
				'description' => $description = $this->generator->string(200),
				'image_content' => base64_encode($this->generator->image()),
        'time' => $time = '2005-08-09T18:31:42+03:00',
		))->result;

		if($this->assertResponse(200))
		{
			$this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
			$this->assertEqual($day->getId(), $res->day_id);
			$this->assertProperty($res, 'image_266');
      $this->assertProperty($res, 'image_532');
			$this->assertEqual(0, $res->likes_count);
			$this->assertProperty($res, 'ctime');
      $this->assertEqual($res->time, $time);
		}
	}

  function testCreateMoment_withGPS()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/moment_create', array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg')),
    ))->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
      $this->assertEqual($day->getId(), $res->day_id);

      $moment = Moment::findOne();
      $this->assertEqual($moment->getLocationLatitude(), '50.5062');
      $this->assertEqual($moment->getLocationLongitude(), '30.6177');
      // http://maps.googleapis.com/maps/api/geocode/json?latlng=50.5062,30.6177&sensor=true
    }
  }

  function testCreateMoment_withoutTime()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/moment_create', array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg')),
    ))->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
      $this->assertEqual($day->getId(), $res->day_id);
      $this->assertEqual($res->time, Moment::stampToIso('1330600003', $this->main_user->getTimezone()));
    }
  }

  function testCreateMoment_CoverOnFirstMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/moment_create', array(
      'description' => $description = $this->generator->string(200),
      'image_content' => base64_encode($this->generator->image()),
      'time' => $time = '2005-08-09T18:31:42+03:00'
    ))->result;

    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId())->exportForApi();
      $this->assertValidImageUrl($loaded_day->image_266);
      $this->assertValidImageUrl($loaded_day->image_532);
    }
  }

  /**
   * @api description Updates information about current <a href="#Entity:Day">day</a> and returns it. You are free to make selective changes.
   * @api input option string title
   * @api input option string occupation Can be omited, then user profile occupation will be used
   * @api input option string type One of pre-defined types, see: GET day/type_names request
   */
  function testUpdate()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);

    $res = $this->post('days/'.$day->getId().'/update', array(
        'title' => $title = $this->generator->string(),
        'occupation' => $occupation = $this->generator->string(255),
        'location' => $location = $this->generator->string(),
        'type' => $type = 'Working day',
        'cover_content' => base64_encode($this->generator->image()),
    ))->result;
    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId());
      $this->assertEqual($loaded_day->getTitle(), $title);
      $this->assertEqual($loaded_day->getOccupation(), $occupation);
      $this->assertEqual($loaded_day->getLocation(), $location);
      $this->assertEqual($loaded_day->getType(), $type);
      $this->assertValidImageUrl($res->image_266);
      $this->assertValidImageUrl($res->image_532);
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
		$this->post('days/'.$day->getId().'/finish')->result;

		$this->assertResponse(200);
	}

	//TODO
	function testFinish_NotFound() {}

  function testUpdate_NotFound()
  {
    $this->_loginAndSetCookie($this->main_user);

    $this->post('days/100500/update', array(
      'title' => $title = $this->generator->string(),
      'occupation' => $occupation = $this->generator->string(),
      'location' => $location = $this->generator->string(),
      'type' => $type = 'Working',
      'cover' => $this->generator->image(),
    ));
    $this->assertResponse(404);
  }

  function testUpdate_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->additional_user);

    $this->post('days/'.$day->getId().'/update', array(
      'title' => $title = $this->generator->string(),
      'occupation' => $occupation = $this->generator->string(),
      'location' => $location = $this->generator->string(),
      'type' => $type = 'Working',
      'cover' => $this->generator->image(),
    ));
    $this->assertResponse(404);
  }

  /**
   * @api description Deletes a day
   * @api input param int day_id
   */
  function testDeleteDay()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/delete')->result;

    $this->assertResponse(200);

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(1, $loaded_day->getIsDeleted());
  }

  function testDelete_NotFound()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/100000/delete')->result;

    $this->assertResponse(404);
  }

  function testDelete_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->additional_user);
    $this->post('days/'.$day->getId().'/delete')->result;

    $this->assertResponse(404);
  }

  /**
   * @api description Restore a deleted day
   * @api input param int day_id
   */
  function testRestoreDay()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsDeleted(1);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/restore')->result;

    $this->assertResponse(200);

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(0, $loaded_day->getIsDeleted());
  }

  function testRestoreDay_NotFound()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/100000/delete')->result;

    $this->assertResponse(404);
  }

  function testRestoreDay_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->additional_user);
    $this->post('days/'.$day->getId().'/restore')->result;

    $this->assertResponse(404);
  }
}
