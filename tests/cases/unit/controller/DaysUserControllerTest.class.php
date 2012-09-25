<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DaysController.class.php');

class DaysUserControllerTest extends odControllerTestCase
{
  protected $controller_class = 'DaysController';

  /**
   * @api description Returns <a href="#Entity:Day">Day</a> entity by given Day ID. Addtitional fields listed below.
   * @api input param int day_id Day ID
   * @api result User user
   * @api result int comments_count
   * @api result DayComment[0-3] comments Few first comments
   * @api result Moment[] moments All day moments
   * @api result bool is_favorite
   */
  function testItem()
  {
    $this->main_user->save();

    $day = $this->generator->dayWithMomentsAndComments();
    $day->save();

    $favorite = $this->main_user->getFavoriteDays();
    $favorite->add($day);
    $favorite->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->assertEqual(0, $day->getViewsCount());

    $response = $this->get('item', [], $day->getId());
    if($this->assertResponse(200))
    {
      $response_day = $response->result;
      $this->assertJsonDay($response_day);
      $this->assertEqualPropertyValues($response_day, $day->exportForApi());
      $this->assertTrue($response_day->is_favorite);

      $this->assertEqual($day->getComments()->count(), $response_day->comments_count);
      $this->assertEqual(lmbToolkit::instance()->getConf('common')->default_comments_count, count($response_day->comments));
      $this->assertEqual($day->getComments()->at(0)->getId(), $response_day->comments[0]->id);
      $this->assertEqual($day->getMoments()->at(0)->getComments()->count(), $response_day->moments[0]->comments_count);
      $this->assertEqual($day->getMoments()->count(), count($response_day->moments));
      $this->assertEqual(1, $response_day->views_count);
    }
  }

  /**
   * @api description Creates comment for <a href="#Entity:Day">day</a> and returns it.
   * @api input param int day_id
   * @api input param string text Comment contents
   */
  function testComment()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('comment', [
      'text' => $text = $this->generator->string(255)
    ], $day->getId());
    if($this->assertResponse(200))
    {
      $response_comment = $response->result;
      $this->assertJsonDayComment($response_comment);

      $this->assertEqual($response_comment->id,   $day->getComments()->at(0)->getId());
      $this->assertEqual($response_comment->text, $text);
    }
  }

  function testCommentCreate_DayNotFound()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $days = Day::find();
    if($this->assertEqual($days->count(), 0)) {
      $response = $this->post('comment', [
        'text' => $text = $this->generator->string(255)
      ], $id = $this->generator->integer());

      if($this->assertResponse(404))
      {
        $this->assertTrue(is_null($response->result));

        $this->assertEqual(1, count($response->errors));
        $this->assertEqual("Day with id='$id' not found", $response->errors[0]);
      }
    }
  }

  /**
   * @api description Share a day
   * @api input param int day_id
   */
  function testShareDay()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->toolkit->getPostingService()->expectOnce('shareDay');

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('share', [], $day->getId());
    if($this->assertResponse(200))
      $this->assertTrue(is_null($response->result));
  }

  /**
   * @api
   */
  function testLike() {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->assertEqual(DayLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('like', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(DayLike::find()->count(), 1);
      $this->assertEqual(Day::findOne()->getLikes()->count(), 1);
    }
  }

  function testLike_TwoTimes()
  {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->assertEqual(DayLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('like', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(DayLike::find()->count(), 1);
      $this->assertEqual(Day::findOne()->getLikes()->count(), 1);
    }

    $response = $this->post('like', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual($response->errors[0], 'Entity already exists');
    }
  }

  function testLike_OwnDay() {
    $day = $this->generator->day($this->additional_user);
    $day->save();

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('like', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(DayLike::find()->count(), 1);
      $this->assertEqual(Day::findOne()->getLikes()->count(), 1);
    }
  }

  /**
   * @api
   */
  function testUnlike() {
    $day = $this->generator->day($this->main_user);
    $day->save();
    $like = $this->generator->dayLike($day, $this->additional_user);
    $like->save();

    $this->assertEqual(DayLike::find()->count(), 1);

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('unlike', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(DayLike::find()->count(), 0);
    }
  }

  function testUnlike_LikeNotExists()
  {
    $day = $this->generator->day($this->main_user);
    $day->save();

    $this->assertEqual(DayLike::find()->count(), 0);

    lmbToolkit::instance()->setUser($this->additional_user);

    $response = $this->post('unlike', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(DayLike::find()->count(), 0);
      $this->assertEqual($response->status, 'Like not found');
    }
  }

  /**
   * @api description Returns favorite based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function testGetFavoriteDays()
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

    $this->main_user->addToFavoriteDays($day1);
    $this->main_user->addToFavoriteDays($day2);
    $this->main_user->addToFavoriteDays($day3);
    $this->main_user->addToFavoriteDays($day4);
    $this->main_user->addToFavoriteDays($day5);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('favorite');
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('favorite', [
      'from' => $day4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('favorite', [
      'from' => $day4->getId(),
      'to' => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('favorite', [
      'from' => $day4->getId(),
      'to' => $day1->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
    }
  }

  /**
   * @api
   */
  function testMarkFavorite()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->assertEqual(0, $this->main_user->getFavoriteDays()->count());

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('mark_favorite', [], $day->getId());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(1, $this->main_user->getFavoriteDays()->count());
      $this->assertEqual($day->getId(), $this->main_user->getFavoriteDays()->at(0)->getId());
    }
  }

  function testMarkFavorite_TwoTimes()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->assertEqual(0, $this->main_user->getFavoriteDays()->count());

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('mark_favorite', [], $day->getId());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(1, $this->main_user->getFavoriteDays()->count());
      $this->assertEqual($day->getId(), $this->main_user->getFavoriteDays()->at(0)->getId());
    }

    $response = $this->post('mark_favorite', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual($response->status, 'Like not found');
    }
  }

  /**
   * @api
   */
  function testUnmarkFavorite()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->main_user->getFavoriteDays()->add($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('unmark_favorite', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(0, $this->main_user->getFavoriteDays()->count());
    }
  }

  function testUnmarkFavorite_TwoTimes()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $day = $this->generator->day($this->additional_user);
    $day->save();

    $this->main_user->getFavoriteDays()->add($day);
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->post('unmark_favorite', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(0, $this->main_user->getFavoriteDays()->count());
    }

    $response = $this->post('unmark_favorite', [], $day->getId());
    if($this->assertResponse(200)) {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(0, $this->main_user->getFavoriteDays()->count());
      $this->assertEqual($response->status, 'Favorite not found');
    }
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

    $day1 = $this->generator->dayWithMoments($this->additional_user);
    $day1->save();
    $day2 = $this->generator->dayWithMoments($this->additional_user);
    $day2->save();
    $day3 = $this->generator->dayWithMoments($this->additional_user);
    $day3->save();
    $day4 = $this->generator->dayWithMoments($this->additional_user);
    $day4->save();
    $day5 = $this->generator->dayWithMoments($this->additional_user);
    $day5->setIsDeleted(1);
    $day5->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('following');
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('following', [
      'from' => $day4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('following', [
      'from' => $day4->getId(),
      'to'   => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('following', [
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days, true);
      $this->assertEqual($day3->getId(), $days[0]->id);
    }
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

    $day1 = $this->generator->dayWithMoments($this->main_user);
    $day1->save();
    $day2 = $this->generator->dayWithMoments($this->main_user);
    $day2->setIsDeleted(1);
    $day2->save();
    $day3 = $this->generator->dayWithMoments($this->main_user);
    $day3->save();
    $day4 = $this->generator->dayWithMoments($this->main_user);
    $day4->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('my');
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day3->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertTrue($days[2]->is_deleted);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('my', [
      'from' => $day4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertTrue($days[1]->is_deleted);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('my', [
      'from' => $day4->getId(),
      'to'   => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertTrue($days[1]->is_deleted);
    }

    $response_with_limit = $this->get('my', [
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days, true);
      $this->assertEqual($day3->getId(), $days[0]->id);
    }
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

    $response = $this->post('complain', [
      'text' => $text = $this->generator->string()
    ], $day->getId());
    if($this->assertResponse(200))
    {
      $response_complaint = $response->result;
      $this->assertEqual($response_complaint->text, $text);

      $complaints = Complaint::find();
      $this->assertEqual($complaints->count(), 1);

      $loaded_complaint = $complaints->at(0);
      $this->assertEqual($loaded_complaint->getId(), $response_complaint->id);
      $this->assertEqual($loaded_complaint->getDayId(), $response_complaint->day_id);
      $this->assertEqual($loaded_complaint->getText(), $text);
    }
  }
}
