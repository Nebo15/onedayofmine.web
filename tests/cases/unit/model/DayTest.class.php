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

  protected function _createValidDay()
  {
    $user = $this->generator->user();
    $user->save();
    return $this->generator->day($user);
  }
}
