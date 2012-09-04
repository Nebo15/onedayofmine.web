<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class UserTest extends odUnitTestCase
{
  function testGetUsersWithOldDays()
  {
    $time_current = time();
    $time_day_ago = $time_current - 24 * 60 * 60 - 1;

    $user_with_old_day = $this->generator->user();
    $user_with_old_day->save();
    $old_day = $this->generator->day($user_with_old_day);
    $old_day->setCtime($time_day_ago);
    $user_with_old_day->setCurrentDay($old_day);
    $user_with_old_day->save();

    $user_with_new_day = $this->generator->user();
    $user_with_new_day->save();
    $old_day = $this->generator->day($user_with_new_day);
    $old_day->setCtime($time_current);
    $user_with_new_day->setCurrentDay($old_day);
    $user_with_new_day->save();

    $users = User::findUsersWithOldDays();
    if($this->assertEqual(1, count($users)))
      $this->assertEqual($user_with_old_day->id, $users[0]->id);

  }
}
