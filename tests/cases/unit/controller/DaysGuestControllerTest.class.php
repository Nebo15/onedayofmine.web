<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/DaysController.class.php');
lmb_require('src/service/InterestCalculator.class.php');

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
   * @api result bool is_favorite
   */
  function estItem()
  {
    $day = $this->generator->dayWithMomentsAndComments();

    $this->assertEqual(0, $day->getViewsCount());

    $response = $this->get('item', [], $day->getId());
    if($this->assertResponse(200))
    {
      $response_day = $response->result;
      $this->assertJsonDay($response_day);
      $this->assertEqualPropertyValues($response_day, $day->exportForApi());

      $this->assertEqual($day->getComments()->count(), $response_day->comments_count);
      $this->assertEqual(lmbToolkit::instance()->getConf('common')->default_comments_count, count($response_day->comments));
      $this->assertEqual($day->getComments()->at(0)->getId(), $response_day->comments[0]->id);
      $this->assertEqual($day->getMoments()->at(0)->getComments()->count(), $response_day->moments[0]->comments_count);
      $this->assertEqual($day->getMoments()->count(), count($response_day->moments));
      $this->assertEqual(1, $response_day->views_count);
    }
  }

  function estItem_NotFound()
  {
    $days = Day::find();
    $this->assertEqual(0, $days->count());

    $response = $this->get('item', [], $id = $this->generator->integer());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Day with id='$id' not found");
    }
  }

  function estItem_DeletedDay()
  {
    $day = $this->generator->day();
    $day->setIsDeleted(1);
    $day->save();

    $response = $this->get('item', [], $id = $day->getId());
    if($this->assertResponse(404))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0], "Day with id='$id' not found");
    }
  }

  /**
   * @api
   */
  function estSearch()
  {
    $this->additional_user->save();

    $day1 = $this->generator->day($this->additional_user, 'fooA');
    $day1->save();
    $day2 = $this->generator->day($this->additional_user, 'Afoo');
    $day2->save();
    $day3 = $this->generator->day($this->additional_user, 'AfooA');
    $day3->save();
    $day4 = $this->generator->day($this->additional_user, 'foo');
    $day4->save();
    $day5 = $this->generator->day($this->additional_user, 'bar');
    $day5->save();
    $day6 = $this->generator->day($this->additional_user, 'foo');
    $day6->setIsDeleted(1);
    $day6->save();

    $this->main_user->addToFavoriteDays($day1);
    $this->main_user->addToFavoriteDays($day2);
    $this->main_user->addToFavoriteDays($day3);
    $this->main_user->addToFavoriteDays($day4);
    $this->main_user->addToFavoriteDays($day5);
    $this->main_user->addToFavoriteDays($day6);
    $this->main_user->save();

    $response = $this->get('search', [
      'query' => 'foo'
    ]);
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

    $response_with_from = $this->get('search', [
      'query' => 'foo',
      'from'  => $day4->getId(),
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

    $response_with_range = $this->get('search', [
      'query' => 'foo',
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days);

      $this->assertEqual($day3->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('search', [
      'query' => 'foo',
      'from'  => $day4->getId(),
      'to'    => $day1->getId(),
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
   * @api description Returns new days based on <a href="#range-request">range-request</a>.
   * @api input option int from
   * @api input option int to
   * @api input option int limit
   * @api result Day[] day
   */
  function estGetNewDays()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $day1 = $this->generator->dayWithMoments($this->additional_user);
    $day1->save();
    $day2 = $this->generator->dayWithMoments($this->main_user);
    $day2->save();
    $day3 = $this->generator->dayWithMoments($this->main_user);
    $day3->setIsDeleted(1);
    $day3->save();
    $day4 = $this->generator->dayWithMoments($this->main_user);
    $day4->save();
    $day5 = $this->generator->dayWithMoments($this->main_user);
    $day5->save();

    $response = $this->get('new');
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day5->getId(), $days[0]->id);
      $this->assertEqual($day4->getId(), $days[1]->id);
      $this->assertEqual($day2->getId(), $days[2]->id);
      $this->assertEqual($day1->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('new', [
      'from' => $day5->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day1->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('new', [
      'from' => $day5->getId(),
      'to'   => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day4->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('new', [
      'from'  => $day5->getId(),
      'to'    => $day1->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days, true);
      $this->assertEqual($day4->getId(), $days[0]->id);
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

    $day1 = $this->generator->dayWithMoments($this->additional_user);
    $this->generator->dayLikes($day1, 4);
    $day1->setCtime($time - $day);
    $day1->save();
    $day2 = $this->generator->dayWithMoments($this->main_user);
    $this->generator->dayLikes($day2, 3);
    $day2->setCtime($time - $day);
    $day2->save();
    $day3 = $this->generator->dayWithMoments($this->additional_user);
    $this->generator->dayLikes($day3, 2);
    $day3->setCtime($time - $day);
    $day3->save();
    $day4 = $this->generator->dayWithMoments($this->main_user);
    $this->generator->dayLikes($day4, 4);
    $day4->setCtime($time - 5 * $day);
    $day4->save();
    $day5 = $this->generator->dayWithMoments($this->additional_user);
    $this->generator->dayLikes($day5, 100);
    $day5->setCtime($time - $day);
    $day5->setIsDeleted(1);
    $day5->save();

    $interests_calculator = new InterestCalculator();

    $interests_calculator->reset();
    $interests_calculator->fillRating();

    $response = $this->get('interesting');
    if($this->assertResponse(200))
    {
      $days = $response->result;
      $this->assertEqual(4, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day1->getId(), $days[0]->id);
      $this->assertEqual($day2->getId(), $days[1]->id);
      $this->assertEqual($day4->getId(), $days[2]->id);
      $this->assertEqual($day3->getId(), $days[3]->id);
    }

    $response_with_from = $this->get('interesting', [
      'from' => $day1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_from->result;
      $this->assertEqual(3, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day2->getId(), $days[0]->id);
      $this->assertEqual($day4->getId(), $days[1]->id);
      $this->assertEqual($day3->getId(), $days[2]->id);
    }

    $response_with_range = $this->get('interesting', [
      'from' => $day1->getId(),
      'to'   => $day3->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_range->result;
      $this->assertEqual(2, count($days));
      $this->assertJsonDayItems($days, true);

      $this->assertEqual($day2->getId(), $days[0]->id);
      $this->assertEqual($day4->getId(), $days[1]->id);
    }

    $response_with_limit = $this->get('interesting', [
      'from'  => $day1->getId(),
      'to'    => $day4->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $days = $response_with_limit->result;
      $this->assertEqual(1, count($days));
      $this->assertJsonDayItems($days, true);
    }
  }

  /**
   * @api description Returns list of acceptable types.
   */
  function estTypes()
  {
    $response = $this->get('types');
    if($this->assertResponse(200))
    {
      $types = $response->result;
      $this->assertEqual($types, Day::getTypes());
    }
  }

  function estComments()
  {
    $day = $this->generator->dayWithComments();
    $day->save();

    $response = $this->get('comments', [], $day->getId());
    if($this->assertResponse(200))
    {
      $comments = $response->result;
      $this->assertEqual(4, count($comments));
      $this->assertJsonDayCommentItems($comments);

      $this->assertEqual($day->getComments()->at(0)->id, $comments[0]->id);
      $this->assertEqual($day->getComments()->at(0)->text, $comments[0]->text);
      $this->assertEqual(lmbToolkit::instance()->getExportHelper()->exportUserSubentity($day->getComments()->at(0)->user), $comments[0]->user);
      $this->assertEqual($day->getComments()->at(1)->id, $comments[1]->id);
      $this->assertEqual($day->getComments()->at(2)->id, $comments[2]->id);
      $this->assertEqual($day->getComments()->at(3)->id, $comments[3]->id);
    }

    $response_with_from = $this->get('comments', [
      'from' => $day->getComments()->at(0)->id
    ], $day->getId());
    if($this->assertResponse(200))
    {
      $comments = $response_with_from->result;
      $this->assertEqual(3, count($comments));
      $this->assertJsonDayCommentItems($comments);

      $this->assertEqual($day->getComments()->at(1)->id, $comments[0]->id);
      $this->assertEqual($day->getComments()->at(2)->id, $comments[1]->id);
      $this->assertEqual($day->getComments()->at(3)->id, $comments[2]->id);
    }

    $response_with_range = $this->get('comments', [
      'from' => $day->getComments()->at(0)->id,
      'to' => $day->getComments()->at(3)->id,
    ], $day->getId());
    if($this->assertResponse(200))
    {
      $comments = $response_with_range->result;
      $this->assertEqual(2, count($comments));
      $this->assertJsonDayCommentItems($comments);

      $this->assertEqual($day->getComments()->at(1)->id, $comments[0]->id);
      $this->assertEqual($day->getComments()->at(2)->id, $comments[1]->id);
    }

    $response_with_limit = $this->get('comments', [
      'from' => $day->getComments()->at(0)->id,
      'to' => $day->getComments()->at(3)->id,
      'limit' => 1
    ], $day->getId());
    if($this->assertResponse(200))
    {
      $comments = $response_with_limit->result;
      $this->assertEqual(1, count($comments));
      $this->assertJsonDayCommentItems($comments);

      $this->assertEqual($day->getComments()->at(1)->id, $comments[0]->id);
    }
  }
}
