<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/InterestCalculator.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/User.class.php');

class InterestCalculatorTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();
    (new InterestCalculator())->reset();
  }

  function testGetDays_Empty()
  {
    $this->assertEqual(0, count((new InterestCalculator())->getDaysRatings()));
  }

  function testFillAndGetDays()
  {
    $calc = new InterestCalculator();
    $time = time();
    $day = 86400;

    $day1 = $this->generator->day();
    $this->generator->dayLikes($day1, 4);
    $day1->ctime = $time - $day;
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $this->generator->dayLikes($day2, 3);
    $day2->ctime = $time - $day;
    $day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $this->generator->dayLikes($day3, 2);
    $day3->ctime = $time - $day;
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $this->generator->dayLikes($day4, 4);
    $day4->ctime = $time - 5 * $day;
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $this->generator->dayLikes($day5, 100);
    $day5->ctime = $time - $day;
    $day5->is_deleted = 1;
    $day5->save();

    $calc->fillRating();

    $days = $calc->getDaysRatings();
    $this->assertEqual(4, count($days));
    $this->assertEqual($day1->id, $days[0]->getDay()->id);
    $this->assertEqual($day2->id, $days[1]->getDay()->id);
    $this->assertEqual($day4->id, $days[2]->getDay()->id);
    $this->assertEqual($day3->id, $days[3]->getDay()->id);

    $days = $calc->getDaysRatings($day1->id);
    $this->assertEqual(3, count($days));
    $this->assertEqual($day2->id, $days[0]->getDay()->id);
    $this->assertEqual($day4->id, $days[1]->getDay()->id);
    $this->assertEqual($day3->id, $days[2]->getDay()->id);

    $days = $calc->getDaysRatings($day1->id, $day3->id);
    $this->assertEqual(2, count($days));
    $this->assertEqual($day2->id, $days[0]->getDay()->id);
    $this->assertEqual($day4->id, $days[1]->getDay()->id);

    $days = $calc->getDaysRatings($day1->id, $day4->id, 1);
    $this->assertEqual(1, count($days));
    $this->assertEqual($day2->id, $days[0]->getDay()->id);
  }
}
