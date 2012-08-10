<?php
lmb_require('tests/cases/acceptance/odAcceptanceTestCase.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class DayAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day', 'Moment', 'DayComment');
  }

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
    $moment1 = $this->generator->moment($day, true);
    $moment2 = $this->generator->moment($day, true);
    $day->addToMoments($moment1);
    $day->addToMoments($moment2);
    $day->save();

    $fav = $this->main_user->getFavouriteDays();
    $fav->add($day);
    $fav->save();

    $this->_loginAndSetCookie($this->main_user);
    $response = $this->get('days/'.$day->getId());
    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertEqual($day->getId(), $loaded_day->id);
      $this->assertEqual($day->getTitle(), $loaded_day->title);
      $this->assertEqual($day->getOccupation(), $loaded_day->occupation);
      $this->assertEqual($day->getLikesCount(), $loaded_day->likes_count);
      $this->assertEqual($day->getCreateTime(), $loaded_day->ctime);
      $this->assertEqual($day->getIsEnded(), $loaded_day->is_ended);
      $this->assertEqual($moment1->getId(), $loaded_day->moments[0]->id);
      $this->assertEqual($moment2->getId(), $loaded_day->moments[1]->id);

      $this->assertEqual($day->getUser()->getId(), $loaded_day->user->id);
      $this->assertTrue($loaded_day->is_favourite);
      $this->assertEqual($day->getComments()->count(), $loaded_day->comments_count);
      $this->assertEqual(lmbToolkit::instance()->getConf('common')->default_comments_count, count($loaded_day->comments));
      $this->assertEqual($day->getComments()->at(0)->getId(), $loaded_day->comments[0]->id);
      $this->assertEqual($day->getMoments()->count(), count($loaded_day->moments));
//      $this->assertEqual($day->getMoments()->at(0)->getComments()->count(), count($loaded_day->moments[0]->comments));
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
    $this->assertEqual($day1->getUserId(), $loaded_days->$day1_id->user->id);
    $this->assertEqual($day1->getMoments()->at(0)->getId(), $loaded_days->$day1_id->moments[0]->id);
    $this->assertEqual($day2->getId(), $loaded_days->$day2_id->id);
    $this->assertEqual($day2->getUserId(), $loaded_days->$day2_id->user->id);
    $this->assertEqual($day2->getMoments()->at(0)->getId(), $loaded_days->$day2_id->moments[0]->id);
    $this->assertEqual(null, $loaded_days->$not_exist_day_id);
  }

  //TODO
  function testItem_NotFound() {
  }

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
   * @api description Creates comment for <a href="#Entity:Day">day</a> and returns it.
   * @api input param int day_id
   * @api input param string text Comment contents
   */
  function testCommentCreate()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('days/'.$day->getId().'/comment_create', array(
      'text' => $text = $this->generator->string(255)
    ))->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($day->getComments()->at(0)->getId(), $res->id);
      $this->assertEqual($day->getId(), $res->day_id);
      $this->assertEqual($text, $res->text);
    }
  }

  //TODO
  function testCommentCreate_NotFound() {}

  /**
   * @api description Share a day
   * @api input param int day_id
   */
  function testShareDay()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->toolkit->copyDayPageToProxy($day);

    $this->_loginAndSetCookie($this->main_user);

    $res = $this->post('days/'.$day->getId().'/share')->result;
    if($this->assertResponse(200))
    {
    	$this->assertProperty($res, 'id');
    	$this->assertTrue($res->id);
    }
  }

  /**
   * @api
   * TODO
   */
  function testLike() {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('days/'.$day->getId().'/like');

    $this->assertResponse(200);
    $this->assertEqual(Day::findOne()->getLikesCount(), 1);
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

    $days = $this
      ->get('days/search', array('query' => 'foo'))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($days));
      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $days = $this
      ->get('days/search', array('query' => 'foo', 'from' => $day4->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this
      ->get('days/search', array(
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
      ->get('days/search', array(
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
   * @api description Returns favourite based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testGetFavouriteDays()
  {
  	$this->additional_user->save();

  	$day1 = $this->generator->day($this->additional_user);
  	$day1->save();
    $day2 = $this->generator->day($this->additional_user);
    $day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $day3->save();
    $day4 = $this->generator->day($this->additional_user);
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $day5->setIsDeleted(1);
    $day5->save();

  	$this->main_user->getFavouriteDays()->add($day1);
    $this->main_user->getFavouriteDays()->add($day2);
    $this->main_user->getFavouriteDays()->add($day3);
    $this->main_user->getFavouriteDays()->add($day4);
    $this->main_user->getFavouriteDays()->add($day5);
  	$this->main_user->save();

  	$this->_loginAndSetCookie($this->main_user);

  	$days = $this
      ->get('days/favourites')
      ->result;
  	if($this->assertResponse(200))
    {
  		$this->assertEqual(4, count($days));
      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $days = $this
      ->get('days/favourites', array('from' => $day4->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this
      ->get('days/favourites', array(
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
      ->get('days/favourites', array(
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
   * @api
   */
  function testAddToFavourites()
  {
  	$this->main_user->save();
  	$this->additional_user->save();
  	$day = $this->generator->day($this->additional_user);
  	$day->save();

  	$this->assertEqual(0, $this->main_user->getFavouriteDays()->count());

  	$this->_loginAndSetCookie($this->main_user);
  	$this->post('/days/'.$day->getId().'/mark_favourite');

  	if($this->assertResponse(200))
  	{
  		$this->assertEqual(1, $this->main_user->getFavouriteDays()->count());
  		$this->assertEqual($day->getId(), $this->main_user->getFavouriteDays()->at(0)->getId());
  	}
  }

  /**
   * @api
   */
  function testRemoveFromFavourites()
  {
  	$this->main_user->save();
  	$this->additional_user->save();
  	$day = $this->generator->day($this->additional_user);
  	$day->save();

  	$this->main_user->getFavouriteDays()->add($day);
  	$this->main_user->save();

  	$this->_loginAndSetCookie($this->main_user);
  	$this->post('/days/'.$day->getId().'/unmark_favourite');

  	if($this->assertResponse(200))
  		$this->assertEqual(0, $this->main_user->getFavouriteDays()->count());
  }

  /**
   * @api description Returns following users days based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testGetFollowingUsersDays()
  {
  	$this->main_user->save();
  	$this->additional_user->addToFollowers($this->main_user);
  	$this->additional_user->save();

  	$day1 = $this->generator->day($this->additional_user);
  	$day1->save();
  	$day2 = $this->generator->day($this->additional_user);
  	$day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $day3->save();
    $day4 = $this->generator->day($this->additional_user);
    $day4->save();
  	$day5 = $this->generator->day($this->additional_user);
  	$day5->setIsDeleted(1);
  	$day5->save();

  	$this->_loginAndSetCookie($this->main_user);

  	$days = $this
  	->get('days/following_users/')
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(4, count($days));
  	$this->assertEqual($day4->getId(), $days[0]->id);
  	$this->assertEqual($day3->getId(), $days[1]->id);
    $this->assertEqual($day2->getId(), $days[2]->id);
    $this->assertEqual($day1->getId(), $days[3]->id);

  	$days = $this
  	->get('days/following_users/', array('from' => $day4->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(3, count($days));
  	$this->assertEqual($day3->getId(), $days[0]->id);
    $this->assertEqual($day2->getId(), $days[1]->id);
    $this->assertEqual($day1->getId(), $days[2]->id);

  	$days = $this
  	->get('days/following_users/', array(
      'from' => $day4->getId(),
      'to'   => $day1->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(2, count($days));
    $this->assertEqual($day3->getId(), $days[0]->id);
    $this->assertEqual($day2->getId(), $days[1]->id);

    $days = $this
      ->get('days/following_users/', array(
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
      'limit' => 1))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($days));
    $this->assertEqual($day3->getId(), $days[0]->id);
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
    $day5 = $this->generator->day($this->main_user);
    $day5->save();

  	$result = $this->get('days/new/')->result;
  	$this->assertResponse(200);
  	$this->assertEqual(4, count($result));
  	$this->assertEqual($day5->getId(), $result[0]->id);
  	$this->assertEqual($day4->getId(), $result[1]->id);
    $this->assertEqual($day2->getId(), $result[2]->id);
    $this->assertEqual($day1->getId(), $result[3]->id);

  	$result = $this->get('days/new/', array('from' => $day5->getId()))->result;
  	$this->assertResponse(200);
  	$this->assertEqual(3, count($result));
  	$this->assertEqual($day4->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);
    $this->assertEqual($day1->getId(), $result[2]->id);

  	$result = $this
  	  ->get('days/new/', array(
        'from' => $day5->getId(),
        'to' => $day1->getId()))
      ->result;
  	$this->assertResponse(200);
  	$this->assertEqual(2, count($result));
    $this->assertEqual($day4->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);

    $result = $this
      ->get('days/new/', array(
        'from' => $day5->getId(),
        'to' => $day1->getId(),
        'limit' => 1))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($result));
    $this->assertEqual($day4->getId(), $result[0]->id);
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

    $result = $this->get('days/interesting/')->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($result));
    $this->assertEqual($day1->getId(), $result[0]->id);
    $this->assertEqual($day2->getId(), $result[1]->id);
    $this->assertEqual($day3->getId(), $result[2]->id);
    $this->assertEqual($day4->getId(), $result[3]->id);

    $result = $this
      ->get('days/interesting/', array('from' => $day1->getId()))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($result));
    $this->assertEqual($day2->getId(), $result[0]->id);
    $this->assertEqual($day3->getId(), $result[1]->id);
    $this->assertEqual($day4->getId(), $result[2]->id);

    $result = $this
      ->get('days/interesting/', array(
        'from' => $day1->getId(),
        'to'   => $day4->getId()))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($result));
    $this->assertEqual($day2->getId(), $result[0]->id);
    $this->assertEqual($day3->getId(), $result[1]->id);

    $result = $this
      ->get('days/interesting/', array(
      'from'  => $day1->getId(),
      'to'    => $day4->getId(),
      'limit' => 1))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($result));
    $this->assertEqual($day2->getId(), $result[0]->id);
  }

  /**
   * @api description Returns current user days based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testCurrentUserDays()
  {
  	$this->main_user->save();
  	$day1 = $this->generator->day($this->main_user);
  	$day1->save();
  	$day2 = $this->generator->day($this->main_user);
    $day2->setIsDeleted(1);
  	$day2->save();
    $day3 = $this->generator->day($this->main_user);
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $day4->save();

  	$this->_loginAndSetCookie($this->main_user);

  	$days = $this
      ->get('days/my')
      ->result;
  	if($this->assertResponse(200))
  	  $this->assertEqual(4, count($days));

    $days = $this
      ->get('days/my', array('from' => $day4->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this
      ->get('days/my', array(
        'from' => $day4->getId(),
        'to' => $day1->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual(true, $days[1]->is_deleted);
    }

    $days = $this
      ->get('days/my', array(
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
   * @api description Returns list of acceptable types.
   */
  function testTypes()
  {
    $types = $this->get('days/types')->result;
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
    odTestsTools::truncateTablesOf('Complaint');
    $day = $this->generator->day();
    $day->save();

    $this->_loginAndSetCookie($this->main_user);
    $res = $this->post('/days/'.$day->getId().'/create_complaint', array(
      'text' => $text = $this->generator->string()
    ));
    $this->assertResponse(200);

    $loaded_complaint = Complaint::find()->at(0);
    $this->assertProperty($res->result, 'id');
    $this->assertEqual($loaded_complaint->getId(), $res->result->id);
    $this->assertEqual($loaded_complaint->getText(), $text);
  }
}
