<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class DayAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment');
  }

  /**
   *@example
   */
  function testCurrentUserDays()
  {
    $this->_loginAndSetCookie($this->main_user);

    $days = $this->get('my/days/')->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
  }

  //TODO separate
  function testBegin_Negative()
  {
    $this->post('days/begin');
    $this->assertResponse(400);

    $this->_loginAndSetCookie($this->main_user);

    $this->get('days/begin');
    $this->assertResponse(405);

    $errors = $this->post('days/begin')->errors;
    $this->assertResponse(400);
    $this->assertEqual('array', gettype($errors));
    $this->assertTrue(0 < count($errors));
  }

  /**
   *@example
   */
  function testBegin()
  {
    $this->_loginAndSetCookie($this->main_user);

    $user = User::findOne();

    $params = array(
      'title' => $this->generator->string(4),
      'description' => $this->generator->string(8),
      'time_offset' => $time = time(),
      'occupation' => $this->generator->string(),
      'age' => $this->generator->integer(2),
      'type' => $this->generator->integer(1)
    );
    $day = $this->post('days/begin', $params)->result;
    $this->assertResponse(200);
    $this->assertEqual($params['title'], $day->title);
    $this->assertEqual($params['description'], $day->description);
    $this->assertEqual($user->getId(), $day->user_id);
    $this->assertTrue($day->time_offset);
    $this->assertTrue($day->ctime);
    $this->assertTrue($day->utime);
  }

  /**
   *@example
   */
  function testItem()
  {
    $day = $this->generator->day();
    $moment1 = $this->generator->moment($day);
    $moment2 = $this->generator->moment($day);
    $day->getUser()->save();
    $day->addToMoments($moment1);
    $day->addToMoments($moment2);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->get('days/'.$day->getId().'/item');

    $loaded_day = $response->result;
    $this->assertResponse(200);
    $this->assertEqual($day->getId(), $loaded_day->id);
    $this->assertEqual($day->getTitle(), $loaded_day->title);
    $this->assertEqual($day->getDescription(), $loaded_day->description);
    $this->assertEqual($day->getTimeOffset(), $loaded_day->time_offset);
    $this->assertEqual($day->getLikesCount(), $loaded_day->likes_count);
    $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);
    $this->assertEqual($day->getIsEnded(), $loaded_day->is_ended);
    $this->assertEqual($moment1->getId(), $loaded_day->moments[0]->id);
    $this->assertEqual($moment2->getId(), $loaded_day->moments[1]->id);
  }

  //todo-
  function testItem_NotFound() {}

  function testItem_DeletedDay()
  {
    $day = $this->generator->day();
    $day->getUser()->save();
    $day->setIsDeleted(1);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->get('days/'.$day->getId().'/item');

    $response->result;
    $this->assertResponse(404);
  }

  /**
   *@example
   */
  function testItem_Many()
  {
    $user1 = $this->generator->user();
    $day1 = $this->generator->day($user1);
    $user1->addToDays($day1);
    $day1->addToMoments($this->generator->moment($day1));
    $user1->save();
    $day1_id = $day1->getId();

    $user2 = $this->generator->user();
    $day2 = $this->generator->day($user2);
    $user2->addToDays($day2);
    $day2->addToMoments($this->generator->moment($day2));
    $user2->save();
    $day2_id = $day2->getId();

    $not_exist_day_id = rand(100, 1000);

    $this->_loginAndSetCookie($this->main_user);
    $ids_string = implode(';', array($day1_id, $day2_id, $not_exist_day_id ));
    $response = $this->get('days/'.$ids_string.'/item');
    $loaded_days = $response->result;

    $this->assertResponse(200);
    $this->assertEqual(
      array($day1_id, $day2_id, $not_exist_day_id),
      array_keys(get_object_vars($loaded_days))
    );
    $this->assertEqual($day1->getId(), $loaded_days->$day1_id->id);
    $this->assertEqual($day1->getUserId(), $loaded_days->$day1_id->user_id);
    $this->assertEqual($day1->getMoments()->at(0)->getId(), $loaded_days->$day1_id->moments[0]->id);
    $this->assertEqual($day2->getId(), $loaded_days->$day2_id->id);
    $this->assertEqual($day2->getUserId(), $loaded_days->$day2_id->user_id);
    $this->assertEqual($day2->getMoments()->at(0)->getId(), $loaded_days->$day2_id->moments[0]->id);
    $this->assertEqual(null, $loaded_days->$not_exist_day_id);
  }

  /**
   *@example
   *todo-high
   */
  function testUpdate()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/42/update', array(
        'tags' => array('tag1', 'tag2'),
        'top_moment_id' => 111)
    );
    $this->assertResponse(200);
  }

  //todo
  function testUpdate_NotFound() {}

  //todo
  function testUpdate_WrongUser() {}

  /**
   *@example
   */
  function testAddMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/add_moment', array(
      'description' => $description = $this->generator->string(200),
      'image_name' => $image_path = 'foo/bar/example.png',
      'image_content' => 'iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc/YPAAAAAElFTkSuQmCC'
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual($day->getMoments()->at(0)->getId(), $res->id);
    $this->assertEqual($day->getId(), $res->day_id);
    $this->assertEqual($description, $res->description);
    $this->assertProperty($res, 'img_url');
    $this->assertEqual(0, $res->likes_count);
    $this->assertProperty($res, 'ctime');
  }

  //todo-low
  function testAddMoment_NotFound() {}

  function testAddMoment_WrongUser()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/add_moment', array(
      'description' => $description = $this->generator->string(200),
      'image_name' => $image_path = 'foo/bar/example.png',
      'image_content' => 'iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc/YPAAAAAElFTkSuQmCC'
    ))->result;

    $this->assertResponse(404);
  }

  /**
   *@example
   */
  function testComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/comment', array(
      'text' => $text = $this->generator->string(255)
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual($day->getComments()->at(0)->getId(), $res->id);
    $this->assertEqual($day->getId(), $res->day_id);
    $this->assertEqual($text, $res->text);
  }

  //todo-
  function testComment_NotFound() {}

  /**
   *@example
   */
  function testEnd()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/end')->result;

    $this->assertResponse(200);

    $res = $this->post('days/'.$day->getId().'/add_moment', array(
      'description' => $this->generator->string(200),
      'image_name' => $this->generator->string(),
      'image_content' => $this->generator->string(),
    ))->errors;
    $this->assertEqual(1, count($res));
  }

  //todo
  function testEnd_NotFound() {}

  //todo
  function testEnd_WrongUser() {}

  /**
   * @example
   */
  function testDelete()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/delete')->result;

    $this->assertResponse(200);

    $loaded_day = Day::findById($day->getId());
    $this->assertEqual(1, $loaded_day->getIsDeleted());
  }

  //todo
  function testDelete_NotFound() {}

  //todo
  function testDelete_WrongUser() {}

  /**
   *@example
   */
  function testShare()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $moment = $this->generator->moment($day);
    $moment->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/share')->result;
    $this->assertResponse(200);

    $this->assertProperty($res, 'id');
    $this->assertTrue($res->id);
  }

  //todo-high
  function testLike() {}

  //todo-high
  function testSearch() {}

  //todo-high
  function testFollowingUsers() {}

  //todo-high
  function testNew() {}

  //todo-high
  function testInteresting() {}

  //todo-high
  function testFavourites() {}

  //todo-high
  function testAddToFavourites() {}

  //todo-high
  function testRemoveFromFavourites() {}
}
