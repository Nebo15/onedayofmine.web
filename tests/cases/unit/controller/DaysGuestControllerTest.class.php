<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DaysController.class.php');

class DaysGuestControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DaysController';

  /**
   * @api description Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.
   * @api input param int day_id Day ID
   * @api result User user
   * @api result int comments_count
   * @api result DayComment[0-3] comments Few first comments
   * @api result Moment[] moments All day moments
   * @api result bool is_favourite
   */
  function testItem()
  {
    $this->main_user->save();

    $day = $this->generator->day(null, true);
    // $day->attachImage($this->generator->image());
    $moment1 = $this->generator->moment($day, true);
    $moment2 = $this->generator->moment($day, true);
    $day->addToMoments($moment1);
    $day->addToMoments($moment2);
    $day->save();
    $day->attachImage($this->generator->image());
    $day->save();

    $response = $this->get('item', array(), $day->getId());
    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertValidDayJson($day, $loaded_day);

      $this->assertEqual($day->getComments()->count(), $loaded_day->comments_count);
      $this->assertEqual(lmbToolkit::instance()->getConf('common')->default_comments_count, count($loaded_day->comments));
      $this->assertEqual($day->getComments()->at(0)->getId(), $loaded_day->comments[0]->id);
      $this->assertEqual($day->getMoments()->at(0)->getComments()->count(), $loaded_day->moments[0]->comments_count);
      $this->assertEqual($day->getMoments()->count(), count($loaded_day->moments));
    }
  }

  /**
   * @api description Get few days in one request.
   * @api input param string ids List of ID's, that was separated by ";".
   * @api result Day[] days See GET days/:id/item
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

    $ids_string = implode(';', array($day1_id, $day2_id, $not_exist_day_id ));
    $response = $this->get('item', array(), $ids_string);
    $loaded_days = $response->result;

    $this->assertResponse(200);
    $this->assertEqual(
      array($day1_id, $day2_id, $not_exist_day_id),
      array_keys(get_object_vars($loaded_days))
    );
    $this->assertEqual($day1->getId(), $loaded_days->$day1_id->id);
    $this->assertEqual($day1->getUserId(), $loaded_days->$day1_id->user->id);
    $this->assertEqual($day1->getMoments()->at(0)->getId(), $loaded_days->$day1_id->moments[0]->id);
    $this->assertEqual($day2->getId(), $loaded_days->$day2_id->id);
    $this->assertEqual($day2->getUserId(), $loaded_days->$day2_id->user->id);
    $this->assertEqual($day2->getMoments()->at(0)->getId(), $loaded_days->$day2_id->moments[0]->id);
    $this->assertEqual(null, $loaded_days->$not_exist_day_id);
  }

  function testItem_NotFound()
  {
    $this->get('item', array(), 100500);
    $this->assertResponse(404);
  }

  function testItem_DeletedDay()
  {
    $day = $this->generator->day();
    $day->getUser()->save();
    $day->setIsDeleted(1);
    $day->save();

    $this->get('item', array(), $day->getId());
    $this->assertResponse(404);
  }

  /**
   * @api
   */
  function testSearch()
  {
    $this->additional_user->save();

    $day1 = $this->generator->day($this->additional_user);
    $day1->setTitle('fooA');
    $day1->save();
    $day2 = $this->generator->day($this->additional_user);
    $day2->setTitle('Afoo');
    $day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $day3->setTitle('AfooA');
    $day3->save();
    $day4 = $this->generator->day($this->additional_user);
    $day4->setTitle('foo');
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $day5->setTitle('bar');
    $day5->save();
    $day6 = $this->generator->day($this->additional_user);
    $day6->setTitle('foo');
    $day6->setIsDeleted(1);
    $day6->save();

    $this->main_user->getFavouriteDays()->add($day1);
    $this->main_user->getFavouriteDays()->add($day2);
    $this->main_user->getFavouriteDays()->add($day3);
    $this->main_user->getFavouriteDays()->add($day4);
    $this->main_user->getFavouriteDays()->add($day5);
    $this->main_user->getFavouriteDays()->add($day6);
    $this->main_user->save();

    $days = $this->get('search', array('query' => 'foo'))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($days));
      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $days = $this->get('search', array('query' => 'foo', 'from' => $day4->getId()))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this
      ->get('search', array(
      'query' => 'foo',
      'from' => $day4->getId(),
      'to' => $day1->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $days = $this
      ->get('search', array(
      'query' => 'foo',
      'from' => $day4->getId(),
      'to' => $day1->getId(),
      'limit' => 1))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
    }
  }

  /**
   * @api description Returns new days based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testGetNewDays()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $day1 = $this->generator->day($this->additional_user);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $day2->save();
    $day3 = $this->generator->day($this->main_user);
    $day3->setIsDeleted(1);
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $day4->save();
    $day4->attachImage($this->generator->image());
    $day4->save();
    $day5 = $this->generator->day($this->main_user);
    $day5->save();

    $result = $this->get('new')->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($result));
    $this->assertEqual($day5->getId(), $result[0]->id);
    $this->assertEqual($day4->getId(), $result[1]->id);
    $this->assertEqual($day2->getId(), $result[2]->id);
    $this->assertEqual($day1->getId(), $result[3]->id);

    $result = $this->get('new', array('from' => $day5->getId()))->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($result));
    $this->assertEqual($day4->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);
    $this->assertEqual($day1->getId(), $result[2]->id);

    $result = $this
      ->get('new', array(
      'from' => $day5->getId(),
      'to' => $day1->getId()))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($result));
    $this->assertEqual($day4->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);

    $result = $this
      ->get('new', array(
      'from' => $day5->getId(),
      'to' => $day1->getId(),
      'limit' => 1))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($result));
      $this->assertValidDayJson($day4, $result[0]);
    }
  }

  /**
   * @api description Returns interesting days based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testGetInterestingDays()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $time = time();
    $day = 86400;

    $day1 = $this->generator->day($this->additional_user);
    $day1->setLikesCount(4);
    $day1->setCtime($time - $day);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $day2->setLikesCount(3);
    $day2->setCtime($time - $day);
    $day2->save();
    $day2->attachImage($this->generator->image());
    $day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $day3->setLikesCount(2);
    $day3->setCtime($time - $day);
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $day4->setLikesCount(4);
    $day4->setCtime($time - 3 * $day);
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $day5->setLikesCount(100);
    $day5->setCtime($time - $day);
    $day5->setIsDeleted(1);
    $day5->save();

    (new InterestCalculator())->reset();
    (new InterestCalculator())->fillRating();

    $result = $this->get('interesting')->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($result));
    $this->assertEqual($day1->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);
    $this->assertEqual($day4->getId(), $result[2]->id);
    $this->assertEqual($day3->getId(), $result[3]->id);

    $result = $this
      ->get('interesting', array('from' => $day1->getId()))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($result));
    $this->assertEqual($day2->getId(), $result[0]->id);
    $this->assertEqual($day4->getId(), $result[1]->id);
    $this->assertEqual($day3->getId(), $result[2]->id);

    $result = $this
      ->get('interesting', array(
      'from' => $day1->getId(),
      'to'   => $day3->getId()))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($result));
    $this->assertEqual($day2->getId(), $result[0]->id);
    $this->assertEqual($day4->getId(), $result[1]->id);

    $result = $this
      ->get('interesting', array(
      'from'  => $day1->getId(),
      'to'    => $day4->getId(),
      'limit' => 1))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($result));
      $this->assertValidDayJson($day2, $result[0]);
    }
  }

  /**
   * @api description Returns list of acceptable types.
   */
  function testTypes()
  {
    $types = $this->get('types')->result;
    $this->assertResponse(200);
    $this->assertEqual($types, Day::getTypes());
  }

  /**
   * @api input param int id ID of abused comment
   * @api input param string text Abuse description message
   * @api result int day_id
   * @api result string text
   * @api result int ctime Creation time, unix timestamp
   * @api result int id Complaint ID
   */
  function testCreateComplaint()
  {
    $day = $this->generator->day();
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('create_complaint',
      array('text' => $text = $this->generator->string()),
      $day->getId()
    );
    $this->assertResponse(200);

    $loaded_complaint = Complaint::find()->at(0);
    $this->assertProperty($res->result, 'id');
    $this->assertEqual($loaded_complaint->getId(), $res->result->id);
    $this->assertEqual($loaded_complaint->getText(), $text);
  }

  function testComments()
  {
    $day = $this->generator->day(null, true);
    $day->save();

    $res = $this->get('comments', array(), $day->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($res));
    $this->assertEqual($day->getComments()->at(0)->id, $res[0]->id);
    $this->assertEqual($day->getComments()->at(0)->text, $res[0]->text);
    $this->assertEqual($day->getComments()->at(0)->user->exportForApi(), $res[0]->user);
    $this->assertEqual($day->getComments()->at(1)->id, $res[1]->id);
    $this->assertEqual($day->getComments()->at(2)->id, $res[2]->id);
    $this->assertEqual($day->getComments()->at(3)->id, $res[3]->id);

    $res = $this
      ->get('comments', array(
        'from' => $day->getComments()->at(0)->id
      ), $day->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($res));
    $this->assertEqual($day->getComments()->at(1)->id, $res[0]->id);
    $this->assertEqual($day->getComments()->at(2)->id, $res[1]->id);
    $this->assertEqual($day->getComments()->at(3)->id, $res[2]->id);

    $res = $this
      ->get('comments', array(
      'from' => $day->getComments()->at(0)->id,
      'to' => $day->getComments()->at(3)->id,
    ), $day->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($res));
    $this->assertEqual($day->getComments()->at(1)->id, $res[0]->id);
    $this->assertEqual($day->getComments()->at(2)->id, $res[1]->id);

    $res = $this
      ->get('comments', array(
      'from' => $day->getComments()->at(0)->id,
      'to' => $day->getComments()->at(3)->id,
      'limit' => 1
    ), $day->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($res));
    $this->assertEqual($day->getComments()->at(1)->id, $res[0]->id);
  }
}
