<?php
lmb_require('tests/cases/acceptance/odAcceptanceTestCase.class.php');

class UserAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day');
  }

  /**
   * @api description Returns days of specified user
   * @api input param int id ID of user
   * @api result Day[] days
   */
  function testUserByIdDays()
  {
    $this->main_user->save();
    $day1 = $this->generator->day($this->main_user);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $day2->save();

    $this->_loginAndSetCookie($this->additional_user);

    $days = $this->get('users/'.$this->main_user->getId().'/days/')->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($days));
    $this->assertEqual($day2->getId(), $days[0]->id);
    $this->assertEqual($day1->getId(), $days[1]->id);
  }

  /**
   * @api description Returns days of specified user
   * @api input param int id ID of user
   * @api result int id User ID
   * @api result string fb_uid Facebook user ID
   * @api result string twitter_uid Twitter user ID
   * @api result string name Displayed name of the user
   * @api result string sex Gender {male,female}.
   * @api result string image_36 URL to small variant of user avatar
   * @api result string image_72 URL to big variant of user avatar
   * @api result string birthday Date of user birthday in format "YYYY-MM-DD"
   * @api result string occupation User occupation
   * @api result string location User location. Usually, but not always, in format "[city], [country]".
   * @api result int followers_count Count of users, that follow selected user
   * @api result int following_count Count of users, that is followed by selected user
   * @api result int days_count Count of days, that was created by selected user
   * @api result bool is_follower TRUE if current logged in user if followed by selected user. Can be ommited if selected user is same as current logged in.
   * @api result bool is_followed TRUE if selected user is followed by current logged in user. Can be ommited if selected user is same as current logged in.
   */
  function testUserById()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    $followers = $this->additional_user->getFollowers();
    $followers->add($this->main_user);
    $followers->save();

    $this->_loginAndSetCookie($this->additional_user);

    $res = (array) $this->get('users/'.$this->main_user->getId().'/item/')->result;

    if($this->assertResponse(200))
    {
      $user = (array) User::findById($this->main_user->getId())->exportForApi();
      $this->assertEqual($user['id'], $res['id']);
      foreach ($res as $key => $value) {
        if(array_key_exists($key, $user))
          $this->assertEqual($user[$key], $value);
      }
      $this->assertTrue($res['is_followed']);
      $this->assertTrue($res['is_follower']);
    }
  }

  function testEmptyFollowers() {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $followers = $this->get('users/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));
  }

  /**
   * @api description Returns list of users that follow current logged in user.
   * @api result User[] followers
   */
  function testFollowers()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->save();

    $followers = $this->get('users/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($followers));
    $this->assertEqual($this->additional_user->getId(), $followers[0]->id);
  }

  /**
   * @api description Returns list of users that follow selected user.
   * @api input param int id ID of user
   * @api result User[] followers
   */
  function testFollowersByUserId()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->additional_user);

    $followers = $this->get('users/'.$this->main_user->getId().'/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->save();

    $followers = $this->get('users/'.$this->main_user->getId().'/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($followers));
    $this->assertEqual($this->additional_user->getId(), $followers[0]->id);
  }

  /**
   * @api description Returns list of users that is followed by current logged in user.
   * @api result User[] followed
   */
  function testFollowing()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $following = $this->get('users/following')->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($following));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $following = $this->get('users/following')->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($following));
    $this->assertEqual($this->additional_user->getId(), $following[0]->id);
  }

  /**
   * @api description Returns list of users that is followed by selected user.
   * @api input param int id ID of user
   * @api result User[] followed
   */
  function testFollowingByUserId()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->additional_user);

    $following = $this->get('users/'.$this->main_user->getId().'/following')->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($following));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $following = $this->get('users/'.$this->main_user->getId().'/following')->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($following));
    $this->assertEqual($this->additional_user->getId(), $following[0]->id);
  }


  /**
   * @api description Start following selected user.
   * @api input param int id ID of user that you want to follow
   */
  function testFollow()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->assertEqual(0, $this->main_user->getFollowing()->count());

    $this->_loginAndSetCookie($this->main_user);
    $this->post('users/'.$this->additional_user->getId().'/follow');
    $this->assertResponse(200);

    $this->assertEqual(1, $this->main_user->getFollowing()->count());
  }

  /**
   * @api description Stop following selected user.
   * @api input param int id ID of user that should be unfollowed
   */
  function testUnfollow()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $this->_loginAndSetCookie($this->main_user);
    $this->post('users/'.$this->additional_user->getId().'/unfollow');
    $this->assertResponse(200);

    $this->assertEqual(0, $this->main_user->getFollowing()->count());
  }

  // TODO
  function testActivity() {}

  /**
   * @api
   */
  function testSearch()
  {
    $user1 = $this->generator->user();
    $user1->setName('foo');
    $user1->save();
    $user2 = $this->generator->user();
    $user2->setName('fooA');
    $user2->save();
    $user3 = $this->generator->user();
    $user3->setName('AfooA');
    $user3->save();
    $user4 = $this->generator->user();
    $user4->setName('foofoo');
    $user4->save();
    $user5 = $this->generator->user();
    $user5->setName('bar');
    $user5->save();

    $users = $this
      ->get('users/search', array('query' => 'foo'))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($users));
      $this->assertEqual($user1->getId(), $users[0]->id);
      $this->assertEqual($user2->getId(), $users[1]->id);
      $this->assertEqual($user3->getId(), $users[2]->id);
      $this->assertEqual($user4->getId(), $users[3]->id);
    }

    $users = $this
      ->get('users/search', array('query' => 'foo', 'from' => $user1->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($users));
      $this->assertEqual($user2->getId(), $users[0]->id);
      $this->assertEqual($user3->getId(), $users[1]->id);
      $this->assertEqual($user4->getId(), $users[2]->id);
    }

    $users = $this
      ->get('users/search', array(
        'query' => 'foo',
        'from'  => $user1->getId(),
        'to'    => $user4->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($users));
      $this->assertEqual($user2->getId(), $users[0]->id);
      $this->assertEqual($user3->getId(), $users[1]->id);
    }

    $users = $this
      ->get('users/search', array(
      'query' => 'foo',
      'from'  => $user1->getId(),
      'to'    => $user4->getId(),
      'limit' => 1))

      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($users));
      $this->assertEqual($user2->getId(), $users[0]->id);
    }
  }
}
