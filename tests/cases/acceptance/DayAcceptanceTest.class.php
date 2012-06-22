<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class DayAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Moment');
  }

  function testBegin_Negative()
  {
    $this->post('day/begin');
    $this->assertResponse(400);

    $this->_loginAndSetCookie($this->main_user);

    $this->get('day/begin');
    $this->assertResponse(405);

    $errors = $this->post('day/begin')->errors;
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
      'time_offset' => $time = time()
    );
    $day = $this->post('day/begin', $params)->result;
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
    $response = $this->get('day/item', array('id' => $day->getId()));

    $loaded_day = $response->result;
    $this->assertResponse(200);
    $this->assertEqual($day->getId(), $loaded_day->id);
    $this->assertEqual($day->getTitle(), $loaded_day->title);
    $this->assertEqual($day->getDescription(), $loaded_day->description);
    $this->assertEqual($day->getTimeOffset(), $loaded_day->time_offset);
    $this->assertEqual($day->getLikesCount(), $loaded_day->likes_count);
    $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);
    $this->assertEqual($moment1->getId(), $loaded_day->moments[0]->id);
    $this->assertEqual($moment2->getId(), $loaded_day->moments[1]->id);
  }

  function testItem_DeletedDay()
  {
    $day = $this->generator->day();
    $day->getUser()->save();
    $day->setIsDeleted(1);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->get('day/item', array('id' => $day->getId()));

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

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->get('day/item', array('id' => array($day1_id, $day2_id)));
    $loaded_days = $response->result;

    $this->assertResponse(200);
    $this->assertEqual(array($day1_id, $day2_id), array_keys(get_object_vars($loaded_days)));
    $this->assertEqual($day1->getId(), $loaded_days->$day1_id->id);
    $this->assertEqual($day1->getUserId(), $loaded_days->$day1_id->user_id);
    $this->assertEqual($day1->getMoments()->at(0)->getId(), $loaded_days->$day1_id->moments[0]->id);
    $this->assertEqual($day2->getId(), $loaded_days->$day2_id->id);
    $this->assertEqual($day2->getUserId(), $loaded_days->$day2_id->user_id);
    $this->assertEqual($day2->getMoments()->at(0)->getId(), $loaded_days->$day2_id->moments[0]->id);
  }

  /**
   *@example
   */
  function testUpdate()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/update', array(
        'day_id' => 42,
        'tags' => array('tag1', 'tag2'),
        'top_moment_id' => 111)
    );
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testAddMoment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('day/add_moment', array(
      'day_id' => $day_id = $day->getId(),
      'description' => $description = $this->generator->string(200),
      'image_name' => $image_path = 'foo/bar/example.png',
      'image_content' => 'iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAIAAABLbSncAAAAAXNSR0IArs4c6QAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9wGEg47HYlSsqsAAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAAOUlEQVQI13VOQQ4AIAiC1v+/TAcKZysOTkQUApCEDpI11YH7EQdJ103jsBA68MG8dutUPrdIFp5xF8lAKftzc/YPAAAAAElFTkSuQmCC'
    ))->result;

    $this->assertResponse(200);
    $this->assertEqual(1, $res->id);
    $this->assertEqual($day_id, $res->day_id);
    $this->assertEqual($description, $res->description);
    $this->assertProperty($res, 'img_url');
    $this->assertEqual(0, $res->likes_count);
    $this->assertProperty($res, 'ctime');
  }

  /**
   *@example
   */
  function testComment()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/comment', array(
      'text' => 'comment text'
    ));
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testEnd()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/end');
    $this->assertResponse(200);
  }

  /**
   *@example
   */
  function testShare()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/share');
    $this->assertResponse(200);
  }
}
