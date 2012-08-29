<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class InterestCalculatorTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();
    $this->toolkit->truncateTablesOf('Day', 'DayLike');
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
    $day1->setCtime($time - $day);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $this->generator->dayLikes($day2, 3);
    $day2->setCtime($time - $day);
    $day2->save();
    $day3 = $this->generator->day($this->additional_user);
    $this->generator->dayLikes($day3, 2);
    $day3->setCtime($time - $day);
    $day3->save();
    $day4 = $this->generator->day($this->main_user);
    $this->generator->dayLikes($day4, 4);
    $day4->setCtime($time - 5 * $day);
    $day4->save();
    $day5 = $this->generator->day($this->additional_user);
    $this->generator->dayLikes($day5, 100);
    $day5->setCtime($time - $day);
    $day5->setIsDeleted(1);
    $day5->save();

    $calc->fillRating();

    $days = $calc->getDaysRatings();
    $this->assertEqual(4, count($days));
    $this->assertEqual($day1->getId(), $days[0]->getDay()->id);
    $this->assertEqual($day2->getId(), $days[1]->getDay()->id);
    $this->assertEqual($day4->getId(), $days[2]->getDay()->id);
    $this->assertEqual($day3->getId(), $days[3]->getDay()->id);

    $days = $calc->getDaysRatings($day1->getId());
    $this->assertEqual(3, count($days));
    $this->assertEqual($day2->getId(), $days[0]->getDay()->id);
    $this->assertEqual($day4->getId(), $days[1]->getDay()->id);
    $this->assertEqual($day3->getId(), $days[2]->getDay()->id);

    $days = $calc->getDaysRatings($day1->getId(), $day3->getId());
    $this->assertEqual(2, count($days));
    $this->assertEqual($day2->getId(), $days[0]->getDay()->id);
    $this->assertEqual($day4->getId(), $days[1]->getDay()->id);

    $days = $calc->getDaysRatings($day1->getId(), $day4->getId(), 1);
    $this->assertEqual(1, count($days));
    $this->assertEqual($day2->getId(), $days[0]->getDay()->id);
  }
}
