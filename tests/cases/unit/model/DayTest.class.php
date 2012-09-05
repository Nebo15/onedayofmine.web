<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class DayTest extends odUnitTestCase
{
  function testValidator()
  {
    $this->assertTrue($this->_createValidDay()->validate());

    $day = $this->_createValidDay();
    $day->setTitle(null);
    $this->assertFalse($day->validate());

    $day = $this->_createValidDay();
    $day->setType(null);
    $this->assertFalse($day->validate());

    $day = $this->_createValidDay();
    $day->setUser(null);
    $this->assertFalse($day->validate());

    $day = $this->_createValidDay();
    $day->setUser(new Day());
    $this->assertFalse($day->validate());
  }

  function testGetMoments()
  {
    $day = $this->generator->day();
    $day->save();

    $last_moment = $this->generator->moment($day);
    list($time, $zone) = Moment::isoToStamp("1970-01-01T23:00:02+01:00");
    $last_moment->setTime($time);
    $last_moment->save();

    $middle_moment = $this->generator->moment($day);
    list($time, $zone) = Moment::isoToStamp("1970-01-02T02:00:01-02:00");
    $middle_moment->setTime($time);
    $middle_moment->save();

    $first_moment = $this->generator->moment($day);
    list($time, $zone) = Moment::isoToStamp("1970-01-01T23:59:59+00:00:00");
    $first_moment->setTime($time);
    $first_moment->save();

    $moments = $day->getMoments();
    $this->assertEqual(3, count($moments));
    $this->assertEqual($first_moment->id, $moments->at(0)->id);
    $this->assertEqual($middle_moment->id, $moments->at(1)->id);
    $this->assertEqual($last_moment->id, $moments->at(2)->id);
  }

  protected function _createValidDay()
  {
    $user = $this->generator->user();
    $user->save();
    return $this->generator->day($user);
  }
}
