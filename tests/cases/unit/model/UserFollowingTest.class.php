<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class UserFollowingTest extends odUnitTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('User', 'UserFollowing');
  }

  function testIsUserFollowUser()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo

    $following = $this->main_user->getFollowing(); // Bar follow Foo
    $following->add($this->additional_user);
    $following->save();

    $this->assertTrue(UserFollowing::isUserFollowUser($this->main_user, $this->additional_user));
    $this->assertFalse(UserFollowing::isUserFollowUser($this->additional_user, $this->main_user));
  }

  function testUserFollowUsers()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum

    $following = $this->main_user->getFollowing(); // Bar follow Foo
    $following->add($this->additional_user);
    $following->save();

    $following = $this->main_user->getFollowing(); // Bar follow Dum
    $following->add($third_user);
    $following->save();

    $collection = new lmbCollection(null. null);
    $collection->add($this->additional_user);
    $collection->add($third_user);

    $result = UserFollowing::isUserFollowUsers($this->main_user, $collection);

    foreach ($result as $value) {
      $this->assertTrue($value);
    }

    $result = UserFollowing::isUsersFollowUser($collection, $this->main_user);

    foreach ($result as $value) {
      $this->assertFalse($value);
    }
  }

  function testIsFollowing()
  {
    $this->main_user->save(); // Bar
    $this->additional_user->save(); // Foo
    $third_user = $this->generator->user(); // Dum

    $following = $this->main_user->getFollowers(); // Foo and Dum follow Bar
    $following->add($this->additional_user);
    $following->add($third_user);
    $following->save();

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

    var_dump($result);
  }
}
