<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DaysController.class.php');

class DaysUserControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DaysController';

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
    $day->save();

    $fav = $this->main_user->getFavouriteDays();
    $fav->add($day);
    $fav->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $response = $this->get('item', array(), $day->getId());
    if($this->assertResponse(200))
    {
      $loaded_day = $response->result;
      $this->assertTrue($loaded_day->is_favourite);
    }
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

    lmbToolkit::instance()->setUser($this->main_user);
    $res = $this->post('comment_create',
      array('text' => $text = $this->generator->string(255)),
      $day->getId()
    )->result;

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

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('share', array(), $day->getId());
    $this->assertResponse(200);
  }

  /**
   * @api
   * TODO
   */
  function testLike() {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('like', array(), $day->getId());

    $this->assertResponse(200);
    $this->assertEqual(Day::findOne()->getLikesCount(), 1);
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

    lmbToolkit::instance()->setUser($this->main_user);

    $days = $this->get('favourite')->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($days));
      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $days = $this->get('favourite', array('from' => $day4->getId()))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this
      ->get('favourite', array(
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
      ->get('favourite', array(
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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('mark_favourite', array(), $day->getId());

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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('unmark_favourite', array(), $day->getId());

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
    $day3->attachImage($this->generator->image());
    $day3->save();
    $day4 = $this->generator->day($this->additional_user);
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $day5->setIsDeleted(1);
    $day5->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $days = $this->get('following_users')->result;
    $this->assertResponse(200);
    $this->assertEqual(4, count($days));
    $this->assertEqual($day4->getId(), $days[0]->id);
    $this->assertEqual($day3->getId(), $days[1]->id);
    $this->assertEqual($day2->getId(), $days[2]->id);
    $this->assertEqual($day1->getId(), $days[3]->id);

    $days = $this->get('following_users', array('from' => $day4->getId()))->result;
    $this->assertResponse(200);
    $this->assertEqual(3, count($days));
    $this->assertEqual($day3->getId(), $days[0]->id);
    $this->assertEqual($day2->getId(), $days[1]->id);
    $this->assertEqual($day1->getId(), $days[2]->id);

    $days = $this
    ->get('following_users', array(
      'from' => $day4->getId(),
      'to'   => $day1->getId()))
    ->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($days));
    $this->assertEqual($day3->getId(), $days[0]->id);
    $this->assertEqual($day2->getId(), $days[1]->id);

    $days = $this
      ->get('following_users', array(
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
      'limit' => 1))
      ->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($days));
    $this->assertEqual($day3->getId(), $days[0]->id);
    $this->assertValidDayJson($day3, $days[0]);
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
    $day3->attachImage($this->generator->image());
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $day4->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $days = $this->get('my')->result;
    if($this->assertResponse(200))
      $this->assertEqual(4, count($days));

    $days = $this->get('my', array('from' => $day4->getId()))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $days = $this->get('my', array('from' => $day4->getId(),'to' => $day1->getId()))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($days));
      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual(true, $days[1]->is_deleted);
    }

    $days = $this
      ->get('my', array(
        'from' => $day4->getId(),
        'to' => $day1->getId(),
        'limit' => 1))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($days));
      $this->assertValidDayJson($day3, $days[0]);
      $this->assertEqual($day3->is_deleted, $days[0]->is_deleted);
    }
  }
}
