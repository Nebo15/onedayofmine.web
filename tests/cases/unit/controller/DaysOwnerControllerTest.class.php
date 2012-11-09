<?php
include_once('src/model/Day.class.php');
include_once('tests/cases/unit/controller/odControllerTestCase.class.php');
include_once('src/controller/DaysController.class.php');

class DaysOwnerControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DaysController';

  function testStart_Negative()
  {
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('start');
    if($this->assertResponse(405))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], 'Not a POST request');
    }

    $response = $this->post('start');
    if($this->assertResponse(400))
    {
      $errors = $response->errors;
      $this->assertTrue(is_array($errors));
      $this->assertTrue(count($errors));
      $this->assertEqual(count($errors), 2);
    }
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

    $response = $this->post('start', [
      'title' => $params->title,
      'type'  => $params->type,
    ]);
    if($this->assertResponse(200))
    {
      $response_day = $response->result;
      $this->assertJsonDay($response_day);
      $this->assertEqualPropertyValues($response_day, $params);
      $this->assertEqual(0, $response->result->likes_count);
    }
  }

  /**
   * @api description Creates <a href="#Entity:Moment">moment</a> in current active day and returns it.
   * @api input param string description
   * @api input param string image_content File contents, that was previously encoded by base64
   * @api input option time ISO time of moment, when image was created
   */
  function testAddMoment()
  {
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('add_moment', [
        'description'   => $description = $this->generator->string(200),
        'time'          => $time        = '2005-08-09T18:31:42+03:00',
        'image_content' => $image       = base64_encode($this->generator->image()),
    ], $day->id);

    if($this->assertResponse(200))
    {
      $moment = $response->result;
      $this->assertJsonMoment($moment, true);
      $this->assertEqual($day->id, Moment::findFirst()->getDay()->id);
      $this->assertEqual($this->main_user->id, Moment::findFirst()->getDay()->getUser()->id);

      $this->assertEqual($moment->likes_count, 0);
      $this->assertEqual($moment->time, $time);
    }
  }

  function testAddMoment_WithGPS()
  {
    $this->main_user->timezone = $this->generator->integer(3);
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('add_moment', [
        'description'   => $description = $this->generator->string(200),
        'time'          => $time        = '2005-08-09T18:31:42+03:00',
        'image_content' => $image       = base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg'))
    ], $day->id);

    if($this->assertResponse(200))
    {
      $moment = $response->result;
      $this->assertJsonMoment($moment, true);
      $this->assertEqual($day->getMoments()->at(0)->id, $moment->id);
      $this->assertEqual($time, $moment->time);

      $loaded_moments = Moment::find();
      if($this->assertEqual($loaded_moments->count(), 1))
      {
        $loaded_moment  = $loaded_moments->at(0);
        $this->assertEqual($loaded_moment->getDay()->id, $day->id);
        $this->assertEqual($loaded_moment->location_latitude, '50.5062');
        $this->assertEqual($loaded_moment->location_longitude, '30.6177');
        // http://maps.googleapis.com/maps/api/geocode/json?latlng=50.5062,30.6177&sensor=true
      }
    }
  }

  function testAddMoment_WithoutTime()
  {
    $this->main_user->timezone = $this->generator->integer(3);
    $this->main_user->save();

    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('add_moment', [
        'description'   => $description = $this->generator->string(200),
        'image_content' => $image       = base64_encode(file_get_contents(lmb_env_get('APP_DIR').'/tests/init/image_with_exif.jpeg'))
    ], $day->id);

    if($this->assertResponse(200))
    {
      $moment = $response->result;
      $this->assertJsonMoment($moment, true);
      $this->assertEqual($day->getMoments()->at(0)->id, $moment->id);
      $this->assertEqual($moment->time, Moment::stampToIso('1330600003', $this->main_user->timezone));
    }
  }

  function testAddMoment_CoverOnFirstMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('add_moment', [
        'description'   => $description = $this->generator->string(200),
        'time'          => $time        = '2005-08-09T18:31:42+03:00',
        'image_content' => $image       = base64_encode($this->generator->image()),
    ], $day->id);

    if($this->assertResponse(200))
    {
      $response_moment = $response->result;
      $this->assertJsonMoment($response_moment, true);

      $loaded_day = Day::findById($day->id);
      $exported   = $this->toolkit->getExportHelper()->exportDay($loaded_day);
      $this->assertJsonDay($exported, true);
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

    $response = $this->post('update', $params = [
      'title'         => $this->generator->string(),
      'type'          => 'Working day',
      'cover_content' => base64_encode($this->generator->image())
    ], $day->id);

    if($this->assertResponse(200))
    {
      $response_day = $response->result;
      $this->assertJsonDay($response_day);
      $this->assertEqualPropertyValues($response_day, (object) $params);

      $loaded_day = Day::findById($day->id);
      $exported   = $this->toolkit->getExportHelper()->exportDay($loaded_day);
      $this->assertJsonDay($exported, true);
      $this->assertEqualPropertyValues($exported, (object) $params);
    }
  }

  function testUpdate_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $days = Day::find();
    if($this->assertEqual($days->count(), 0)) {
      $response = $this->post('update', [
        'title' => $title = $this->generator->string(),
        'type'  => $type  = 'Working day',
        'cover' => $image = $this->generator->image(),
      ],           $id    = $this->generator->integer());

      if($this->assertResponse(404)) {
        $this->assertTrue(is_null($response->result));

        $this->assertEqual(1, count($response->errors));
        $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
      }
    }
  }

  function testUpdate_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('update', [
        'title' => $title = $this->generator->string(),
        'type'  => $type  = 'Working day',
        'cover' => $image = $this->generator->image(),
    ], $day->id);

    if($this->assertResponse(401)) {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
    }
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

    $response = $this->get('current');

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertJsonDay($loaded_day);
      $this->assertEqual($day->id, $loaded_day->id);
    }
  }

  function testCurrent_CurrentDayNotSet()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('current');

    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current day not set", $response->errors[0]);
    }
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

    $response = $this->post('mark_current', [], $day->id);

    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $user = User::findById($this->main_user->id);
      $this->assertEqual($user->current_day_id, $day->id);
    }
  }

  function testMarkCurrent_DayNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $days = Day::find();
    if($this->assertEqual($days->count(), 0)) {
      $response = $this->post('mark_current', [], $id = $this->generator->integer());

      if($this->assertResponse(404)) {
        $this->assertTrue(is_null($response->result));

        $this->assertEqual(1, count($response->errors));
        $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
      }
    }
  }

  /**
   * @api description Finish current day.
   * @api input option string final_description Final day comment.
   */
  function testFinish()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->main_user->setCurrentDay($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('finish', [
      'image_content'     => $image_content = base64_encode($this->generator->image()),
      'final_description' => $comment_text  = $this->generator->string()
    ], $day->id);

    if($this->assertResponse(200))
    {
      $response_day = $response->result;
      $this->assertJsonDay($response_day, true);
      $this->assertEqual($day->id, $response_day->id);
      $this->assertTrue($response_day->final_description);

      $loaded_day = Day::findFirst();
      $this->assertEqual(count($loaded_day->getComments()), 0);
      $this->assertTrue($loaded_day->final_description);
      $this->assertEqual($loaded_day->final_description, $comment_text);

      $user = User::findById($this->main_user->id);
      $this->assertEqual(0, $user->current_day_id);
    }
  }

  function testFinish_CurrentDayNotSet()
  {
    $day = $this->generator->dayWithMoments($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->post('finish', [], $day->id);

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertJsonDay($loaded_day, true);
      $this->assertEqual($day->id, $loaded_day->id);
    }
  }

  function testFinish_NotCurrentDayId()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $day2 = $this->generator->day($this->main_user);
    $day2->save();

    $this->main_user->setCurrentDay($day2);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('finish', [], $day->id);

    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertJsonDay($loaded_day);
      $this->assertEqual($day->id, $loaded_day->id);

      $user = User::findById($this->main_user->id);
      $this->assertEqual($user->current_day_id, $day2->id);
    }
  }

  function testFinish_DayNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $days = Day::find();
    if($this->assertEqual($days->count(), 0)) {
      $response = $this->post('finish', [], $id = $this->generator->integer());

      if($this->assertResponse(404))
      {
        $this->assertTrue(is_null($response->result));

        $this->assertEqual(1, count($response->errors));
        $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
      }
    }
  }

  function testFinish_ForNotOwner()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->main_user->setCurrentDay($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('finish', [
      'image_content'     => $image_content = base64_encode($this->generator->image()),
      'final_description' => $comment_text  = $this->generator->string()
    ], $day->id);

    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
    }
  }

  /**
   * @api description Deletes a day
   * @api input param int day_id
   */
  function testDelete()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $day->id);

    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $loaded_day = Day::findById($day->id);
      $this->assertEqual(1, $loaded_day->is_deleted);
    }
  }

  function testDelete_DayNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $id = $this->generator->integer());

    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
    }
  }

  function testDelete_ForNotOwner()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('delete', [], $day->id);

    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
    }
  }

  /**
   * @api description Restore a deleted day
   * @api input param int day_id
   */
  function testRestoreDay()
  {
    $day = $this->generator->day($this->main_user);
    $day->is_deleted = 1;
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('restore', [], $day->id);

    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $loaded_day = Day::findById($day->id);
      $this->assertEqual(0, $loaded_day->is_deleted);
    }
  }

  function testRestoreDay_NotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('delete', [], $id = $this->generator->integer());

    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
    }
  }

  function testRestoreDay_WrongUser()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->post('restore', [], $day->id);

    if($this->assertResponse(401))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, count($response->errors));
      $this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
    }
  }
}
