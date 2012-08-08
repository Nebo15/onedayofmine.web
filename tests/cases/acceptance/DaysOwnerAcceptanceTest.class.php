<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

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

		$day = $this->post('days/start', array(
      'title' => $params->title,
      'location' => $params->location,
      'occupation' => $params->occupation,
      'type' => $params->type,
    ))->result;
		if($this->assertResponse(200))
    {
      $this->assertEqual($params->title, $day->title);
      $this->assertEqual($params->occupation, $day->occupation);
      $this->assertEqual($params->location, $day->location);
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

    $day = $this->post('days/start', $params)->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual($params->title, $day->title);
      $this->assertEqual($this->main_user->getId(), $day->user_id);
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
		$res = $this->post('days/'.$day->getId().'/moment_create', array(
				'description' => $description = $this->generator->string(200),
				'img_content' => base64_encode($this->generator->image()),
        'time' => $time = '2005-08-09T18:31:42+03:00'
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

  function testCreateMoment_CoverOnFirstMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->setIsEnded(0);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/moment_create', array(
      'description' => $description = $this->generator->string(200),
      'img_content' => base64_encode($this->generator->image()),
      'time' => $time = '2005-08-09T18:31:42+03:00'
    ))->result;

    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId())->exportForApi();
      $img = @file_get_contents($loaded_day->cover_image_266);
      $this->assertTrue($img, "Cover image {$loaded_day->cover_image_266} not found");
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

    $this->post('days/'.$day->getId().'/update', array(
        'title' => $title = $this->generator->string(),
        'occupation' => $occupation = $this->generator->string(255),
        'location' => $location = $this->generator->string(),
        'type' => $type = 'Working',
        'cover_content' => base64_encode($this->generator->image()),
    ));
    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId());
      $this->assertEqual($loaded_day->getTitle(), $title);
      $this->assertEqual($loaded_day->getOccupation(), $occupation);
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
