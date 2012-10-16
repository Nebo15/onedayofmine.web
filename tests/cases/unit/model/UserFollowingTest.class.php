<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/model/User.class.php');

class UserFollowingTest extends odUnitTestCase
{

  function testIsUserFollowUser()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo

    $link = new UserFollowing();
    $link->setUser($this->additional_user);
    $link->setFollowerUser($this->main_user);
    $link->save();

    $this->assertTrue(UserFollowing::isUserFollowUser($this->main_user, $this->additional_user));
    $this->assertFalse(UserFollowing::isUserFollowUser($this->additional_user, $this->main_user));
  }

  function testUserFollowUsers()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum
    $third_user->save();

    $this->generator->follow($this->main_user, $this->additional_user);
    $this->generator->follow($this->main_user, $third_user);

    $collection = new lmbCollection(null. null);
    $collection->add($this->additional_user);
    $collection->add($third_user);

    $this->main_user->getDbConnection()->commitTransaction();

    $result = UserFollowing::isUserFollowUsers($this->main_user, $collection);

    foreach ($result as $value) {
      $this->assertTrue($value);
    }

    $result = UserFollowing::isUsersFollowUser($collection, $this->main_user);

    foreach ($result as $value) {
      $this->assertFalse($value);
    }
  }

  function testUserFollowUsers_empty()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum
    $third_user->save();

    $this->main_user->getDbConnection()->commitTransaction();

    $collection = new lmbCollection(null. null);
    $collection->add($this->additional_user);
    $collection->add($third_user);

    $result = UserFollowing::isUserFollowUsers($this->main_user, $collection);
    foreach ($result as $value) {
      $this->assertFalse($value);
    }
  }

  function testUsersFollowUser()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum
    $third_user->save();

    $this->generator->follow($this->main_user, $this->additional_user);
    $this->generator->follow($this->main_user, $third_user);

    $this->main_user->getDbConnection()->commitTransaction();

    $collection = new lmbCollection(null. null);
    $collection->add($this->additional_user);
    $collection->add($third_user);

    $result = UserFollowing::isUserFollowUsers($this->main_user, $collection);

    foreach ($result as $value) {
      $this->assertFalse($value);
    }

    $result = UserFollowing::isUsersFollowUser($collection, $this->main_user);

    foreach ($result as $value) {
      $this->assertTrue($value);
    }
  }

  function testUsersFollowUser_empty()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum
    $third_user->save();

    $this->main_user->getDbConnection()->commitTransaction();

    $collection = new lmbCollection(null. null);
    $collection->add($this->additional_user);
    $collection->add($third_user);

    $result = UserFollowing::isUsersFollowUser($collection, $this->main_user);
    foreach ($result as $value) {
      $this->assertFalse($value);
    }
  }
}
