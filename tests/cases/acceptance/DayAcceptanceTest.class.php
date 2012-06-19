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
      'time_offset' => $time = time(),
      'tags' => array('tag1', 'tag2')
    );
    $day = $this->post('day/begin', $params)->result;
    $this->assertResponse(200);
    $this->assertEqual($params['title'], $day->title);
    $this->assertEqual($params['description'], $day->description);
    $this->assertEqual($params['tags'], $day->tags);
    $this->assertEqual($user->getId(), $day->user_id);
    $this->assertTrue($day->time_offset);
    $this->assertTrue($day->ctime);
    $this->assertTrue($day->utime);
    $this->assertTrue($day->cip);
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
  function estSetMainImage()
  {
    $day = $this->generator->day();
    $this->generator->moment($day);
    $day->getUser()->save();
    $day->save();
  }

  /**
   *@example
   */
  function testItems()
  {
    $this->_loginAndSetCookie($this->main_user);
    $days = $this->get('day/items', array('ids' => array(42, 42)))->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->img_url);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
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
