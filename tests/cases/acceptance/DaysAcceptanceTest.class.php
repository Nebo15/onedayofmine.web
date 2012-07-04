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
    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
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
   *@example
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
   *@example
   */
  function testShareDay()
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

  //TODO
  function testLike() {}

  //TODO
  function testSearch() {}

  /**
   *@example
   *TODO
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

  //TODO
  function testUpdate_NotFound() {
  }

  //TODO
  function testUpdate_WrongUser() {
  }

  /**
   * @example
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

  //TODO
  function testDelete_NotFound() {
  }

  //TODO
  function testDelete_WrongUser() {
  }

  //TODO
  function testRestoreDay() {
  }

  //TODO
  function testRestoreDay_NotFound() {
  }

  //TODO
  function testRestoreDay_WrongUser() {
  }

  /**
   * @example
   */
  function testGetFavouriteDays()
  {
  	$this->additional_user->save();
  	$day = $this->generator->day($this->additional_user);
  	$day->save();

  	$this->main_user->getFavouriteDays()->add($day);
  	$this->main_user->save();

  	$this->_loginAndSetCookie($this->main_user);
  	$days = $this->get('days/favourites')->result;
  	if($this->assertResponse(200))
  	{
  		$this->assertEqual(1, count($days));
  		$this->assertEqual($day->getId(), $days[0]->id);
  	}
  }

  /**
   * @example
   */
  function testAddToFavourites()
  {
  	$this->main_user->save();
  	$this->additional_user->save();
  	$day = $this->generator->day($this->additional_user);
  	$day->save();

  	$this->assertEqual(0, $this->main_user->getFavouriteDays()->count());

  	$this->_loginAndSetCookie($this->main_user);
  	$this->post('/days/'.$day->getId().'/favourite');

  	if($this->assertResponse(200))
  	{
  		$this->assertEqual(1, $this->main_user->getFavouriteDays()->count());
  		$this->assertEqual($day->getId(), $this->main_user->getFavouriteDays()->at(0)->getId());
  	}
  }

  /**
   * @example
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
  	$this->post('/days/'.$day->getId().'/unfavourite');

  	if($this->assertResponse(200))
  		$this->assertEqual(0, $this->main_user->getFavouriteDays()->count());
  }

  /**
   * @example
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
  	$day3->setIsDeleted(1);
  	$day3->save();

  	$this->_loginAndSetCookie($this->main_user);

  	$days = $this
  	->get('days/following_users/')
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(2, count($days));
  	$this->assertEqual($day1->getId(), $days[0]->id);
  	$this->assertEqual($day2->getId(), $days[1]->id);

  	$days = $this
  	->get('days/following_users/', array('from' => $day1->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(1, count($days));
  	$this->assertEqual($day2->getId(), $days[0]->id);

  	$days = $this
  	->get('days/following_users/', array('from' => $day1->getId(), 'to' => $day2->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(0, count($days));
  }

  /**
   * @example
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

  	$this->_loginAndSetCookie($this->additional_user);

  	$result = $this->get('days/new/')->result;
  	$this->assertResponse(200);
  	$this->assertEqual(2, count($result));
  	$this->assertEqual($day1->getId(), $result[0]->id);
  	$this->assertEqual($day2->getId(), $result[1]->id);

  	$result = $this
  	->get('days/new/', array('from' => $day1->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(1, count($result));
  	$this->assertEqual($day2->getId(), $result[0]->id);

  	$result = $this
  	->get('days/new/', array('from' => $day1->getId(), 'to' => $day2->getId()))
  	->result;
  	$this->assertResponse(200);
  	$this->assertEqual(0, count($result));
  }

  //TODO
  function testGetInterestingDays() {
  }

  /**
   * @example
   */
  function testCurrentUserDays()
  {
  	$this->main_user->save();
  	$day1 = $this->generator->day($this->main_user);
  	$day1->save();
  	$day2 = $this->generator->day($this->main_user);
  	$day2->save();

  	$this->_loginAndSetCookie($this->main_user);

  	$days = $this->get('days/my')->result;
  	$this->assertResponse(200);
  	$this->assertEqual(2, count($days));
  	$this->assertEqual($day1->getId(), $days[0]->id);
  	$this->assertEqual($day2->getId(), $days[1]->id);
  }
}
