<?php
lmb_require('tests/cases/odUnitTestCase.class.php');
lmb_require('src/service/InterestCalculator.class.php');

class InterestCalculatorTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();
    $this->toolkit->truncateTablesOf('Day');
    (new InterestCalculator())->reset();
  }

  function testGetDays_Empty()
  {
    $this->assertEqual(0, count((new InterestCalculator())->getDays()));
  }

  function testFillAndGetDays()
  {
    $calc = new InterestCalculator();
    $time = time();
    $day = 86400;

    $day1 = $this->generator->day();
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

    $calc->fillRating();

    $days = $calc->getDays();
    $this->assertEqual(4, count($days));
    $this->assertEqual($day1->getId(), $days[0]->id);
    $this->assertEqual($day2->getId(), $days[1]->id);
    $this->assertEqual($day3->getId(), $days[2]->id);
    $this->assertEqual($day4->getId(), $days[3]->id);

    $days = $calc->getDays($day1->getId());
    $this->assertEqual(3, count($days));
    $this->assertEqual($day2->getId(), $days[0]->id);
    $this->assertEqual($day3->getId(), $days[1]->id);
    $this->assertEqual($day4->getId(), $days[2]->id);

    $days = $calc->getDays($day1->getId(), $day4->getId());
    $this->assertEqual(2, count($days));
    $this->assertEqual($day2->getId(), $days[0]->id);
    $this->assertEqual($day3->getId(), $days[1]->id);

    $days = $calc->getDays($day1->getId(), $day4->getId(), 1);
    $this->assertEqual(1, count($days));
    $this->assertEqual($day2->getId(), $days[0]->id);
  }
}
