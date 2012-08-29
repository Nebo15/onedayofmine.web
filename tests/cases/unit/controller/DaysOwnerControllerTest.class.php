<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DaysController.class.php');

class DaysOwnerControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DaysController';


  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment', 'DayLike', 'MomentLike', 'DayFinishComment');
  }

  function testStart_Negative()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $this->get('start');
    $this->assertResponse(405);

    $errors = $this->post('start')->errors;
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

    lmbToolkit::instance()->setUser($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();

    $response = $this->post('start', array(
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
    }
  }

  function testStart_withNoOccupation() {

    $this->main_user->setOccupation('testStart_withNoOccupation - user');
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();
    $params->occupation = null;

    $response = $this->post('start', array(
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
    }
  }

  function testStart_withNoLocation()
  {
    $this->main_user->setLocation('testStart_withNoLocation - user');
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();
    $params->location = null;

    $response = $this->post('start', array(
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
    }
  }

  function testStart_ExpiredToken()
  {
    $this->main_user->save();

    $this->toolkit->setUser($this->main_user);
    $this->toolkit->setPostingService(new PostingServiceWithExpiredToken());

    $day = $this->generator->day($this->main_user);
    $params = $day->exportForApi();

    $this->post('start', array(
      'title' => $params->title,
      'location' => $params->location,
      'occupation' => $params->occupation,
      'type' => $params->type,
      'token' => 'wrong-token'
    ));

    $this->assertResponse(401);
  }

  /**
   * @api description Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.
   * @api input param string description
   * @api input param string image_content File contents, that was previously encoded by base64
   * @api input option time ISO time of moment, when image was created
   */
  function testAddMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('add_moment',
      array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode($this->generator->image()),
        'time' => $time = '2005-08-09T18:31:42+03:00',),
      $day->getId()
    )->result;

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

  function testAddMoment_withGPS()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('add_moment',
      array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg'))),
      $day->getId()
    )->result;

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

  function testAddMoment_withoutTime()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('add_moment',
      array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg'))),
      $day->getId()
    )->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
      $this->assertEqual($day->getId(), $res->day_id);
      $this->assertEqual($res->time, Moment::stampToIso('1330600003', $this->main_user->getTimezone()));
    }
  }

  function testAddMoment_CoverOnFirstMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('add_moment',
      array(
        'description' => $description = $this->generator->string(200),
        'image_content' => base64_encode($this->generator->image()),
        'time' => $time = '2005-08-09T18:31:42+03:00'),
      $day->getId()
    )->result;

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
   * @api input option string cover_content base64 encoded image content
   */
  function testUpdate()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('update',
      array(
        'title' => $title = $this->generator->string(),
        'occupation' => $occupation = $this->generator->string(255),
        'location' => $location = $this->generator->string(),
        'type' => $type = 'Working day',
        'cover_content' => base64_encode($this->generator->image())),
      $day->getId()
    )->result;

    if($this->assertResponse(200))
    {
      $loaded_day = Day::findById($day->getId());
      $this->assertValidDayJson($loaded_day, $response);
    }
  }

  function testUpdate_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

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
    $day->save();

    $this->toolkit->setUser($this->additional_user);

    $this->post('update',
      array(
        'title' => $title = $this->generator->string(),
        'occupation' => $occupation = $this->generator->string(),
        'location' => $location = $this->generator->string(),
        'type' => $type = 'Working',
        'cover' => $this->generator->image(),
      ),
      $day->getId());
    $this->assertResponse(401);
  }

  /**
   * @api description Get current day.
   */
  function testCurrent()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->main_user->setCurrentDay($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('current');

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertEqual($day->getId(), $loaded_day->id);
      $this->assertEqual($day->getTitle(), $loaded_day->title);
      $this->assertEqual($day->getOccupation(), $loaded_day->occupation);
      $this->assertEqual($day->getLikes()->count(), $loaded_day->likes_count);
      $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);
    }
  }

  function testCurrent_notSet()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('days/current');

    $this->assertResponse(404);
  }

  /**
   * @api description Mark day as current
   * @api input param int id Day ID
   */
  function testMarkCurrent()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('mark_current', array(), $day->getId());

    $this->assertResponse(200);
    $this->assertFalse($response->result);

    $user = User::findById($this->main_user->getId());
    $this->assertEqual($user->getCurrentDay()->getId(), $day->getId());
  }

  function testMarkCurrent_notFound()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('days/1337/mark_current');

    $this->assertResponse(404);
  }

  /**
   * @api description Finish current day.
   */
  function testFinish()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->main_user->setCurrentDay($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('finish',
      array(
        'image_content' => $image_content = base64_encode($this->generator->image()),
        'comment' => $comment_text = $this->generator->string()
      ),
      $day->getId()
    );

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertEqual($day->getId(), $loaded_day->id);
      $this->assertEqual($day->getTitle(), $loaded_day->title);
      $this->assertEqual($day->getOccupation(), $loaded_day->occupation);
      $this->assertEqual($day->getLikes()->count(), $loaded_day->likes_count);
      $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);

      $db_day = Day::findOne();
      $this->assertProperty($loaded_day, 'finish_comment');
      $this->assertTrue($loaded_day->finish_comment);
      $this->assertEqual(count($db_day->getComments()), 0);
      $this->assertTrue($db_day->getFinishComment());
      $this->assertEqual($db_day->getFinishComment()->getText(), $comment_text);

      $this->assertValidImageUrl($loaded_day->image_266);
      $this->assertValidImageUrl($loaded_day->image_532);

      $user = User::findById($this->main_user->getId());
      $this->assertFalse($user->getCurrentDay());
    }
  }

  function testFinish_noCurrentDay()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('finish', array(), $day->getId());

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertEqual($day->getId(), $loaded_day->id);
      $this->assertEqual($day->getTitle(), $loaded_day->title);
      $this->assertEqual($day->getOccupation(), $loaded_day->occupation);
      $this->assertEqual($day->getLikes()->count(), $loaded_day->likes_count);
      $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);
    }
  }

  function testFinish_notCurrentDay()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $day2 = $this->generator->day($this->main_user);
    $day2->save();

    $this->main_user->setCurrentDay($day2);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('finish', array(), $day->getId());

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertEqual($day->getId(), $loaded_day->id);
      $this->assertEqual($day->getTitle(), $loaded_day->title);
      $this->assertEqual($day->getOccupation(), $loaded_day->occupation);
      $this->assertEqual($day->getLikes()->count(), $loaded_day->likes_count);
      $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);

      $user = User::findById($this->main_user->getId());
      $this->assertEqual($user->getCurrentDay()->getId(), $day2->getId());
    }
  }

  function testFinish_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('finish', array(), 100500);

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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), $day->getId());

    $this->assertResponse(200);

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(1, $loaded_day->getIsDeleted());
  }

  function testDelete_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), 100500);

    $this->assertResponse(404);
  }

  function testDelete_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->toolkit->setUser($this->additional_user);
    $this->post('delete', array(), $day->getId())->result;

    $this->assertResponse(401);
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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('restore', array(), $day->getId())->result;

    $this->assertResponse(200);

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(0, $loaded_day->getIsDeleted());
  }

  function testRestoreDay_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('delete', array(), 100500)->result;

    $this->assertResponse(404);
  }

  function testRestoreDay_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->toolkit->setUser($this->additional_user);
    $this->post('restore', array(), $day->getId())->result;

    $this->assertResponse(401);
  }
}

class PostingServiceWithExpiredToken extends odPostingService
{
  function share($name, $args)
  {
    throw new odFacebookApiExpiredTokenException('Who are you? Come on, "Goodbye!"');
  }
}
