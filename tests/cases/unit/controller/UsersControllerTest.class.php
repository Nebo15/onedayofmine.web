<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/UsersController.class.php');

class UsersControllerTest extends odControllerTestCase
{
  protected $controller_class = 'UsersController';

  /**
   * @api description Returns days of specified user
   * @api input param int id ID of user
   * @api result Day[] days
   */
  function testUserDays()
  {
    $this->main_user->save();
    $day1 = $this->generator->day($this->main_user);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $day2->save();

    $this->toolkit->setUser($this->additional_user);

    $days = $this->get('days', array(), $this->main_user->getId())->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($days));
      $this->assertEqual($day2->getId(), $days[0]->id);
      $this->assertEqual($day1->getId(), $days[1]->id);
    }
  }

  /**
   * @api description Returns days of specified user
   * @api input param int id ID of user
   * @api result int id User ID
   * @api result string facebook_uid Facebook user ID
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
   * @api result bool following TRUE if selected user is followed by current logged in user. Can be ommited if selected user is same as current logged in.
   */
  function testUser()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    $followers = $this->additional_user->getFollowers();
    $followers->add($this->main_user);
    $followers->save();

    $this->toolkit->setUser($this->additional_user);

    $res = (array) $this->get('item', array(), $this->main_user->getId())->result;

    if($this->assertResponse(200))
    {
      $user = (array) User::findById($this->main_user->getId())->exportForApi();
      $this->assertEqual($user['id'], $res['id']);
      foreach ($res as $key => $value) {
        if(array_key_exists($key, $user))
          $this->assertEqual($user[$key], $value);
      }
      $this->assertTrue($res['following']);
    }
  }

  function testEmptyFollowers() {
    $this->main_user->save();
    $this->additional_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('followers', array(), $this->main_user->getId());
    $followers = $response->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));
  }

  /**
   * @api description Returns list of users that follow selected user.
   * @api input param int id ID of user
   * @api result User[] followers
   */
  function testFollowers()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $followers = $this->get('followers', array(), $this->main_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->add($third_user);
    $followers->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $followers = $this->get('followers', array(), $this->main_user->getId())->result;

    $this->assertResponse(200);
    $this->assertEqual(2, count($followers));
    $this->assertEqual($this->additional_user->getId(), $followers[0]->id);
    $this->assertTrue($followers[0]->following);
    $this->assertTrue($followers[1]->following);
    $this->assertEqual($this->additional_user->getId(), $followers[0]->id);
    $this->assertEqual($third_user->getId(), $followers[1]->id);
  }

  function testFollowers_anotherUser()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $followers = $this->get('followers', array(), $this->main_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));

    $followers = $this->additional_user->getFollowers();
    $followers->add($third_user);
    $followers->add($this->main_user);
    $followers->save();

    $followers = $this->main_user->getFollowers();
    $followers->add($third_user);
    $followers->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $followers = $this->get('followers', array(), $this->additional_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($followers));
    $this->assertFalse($followers[0]->following);
    $this->assertTrue($followers[1]->following);
    $this->assertEqual($this->main_user->getId(), $followers[0]->id);
    $this->assertEqual($third_user->getId(), $followers[1]->id);
  }

  /**
   * @api description Returns list of users that is followed by selected user.
   * @api input param int id ID of user
   * @api result User[] followed
   */
  function testFollowing()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $following = $this->get('following', array(), $this->main_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($following));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->add($third_user);
    $following->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $following = $this->get('following', array(), $this->main_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(2, count($following));
    $this->assertEqual($this->additional_user->getId(), $following[0]->id);
    $this->assertTrue($following[0]->following);
    $this->assertFalse($following[1]->following);
  }

  function testFollowing_anotherUser()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $following = $this->get('following', array(), $this->main_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($following));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->add($third_user);
    $following->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $following = $this->get('following', array(), $this->additional_user->getId())->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($following));
    $this->assertEqual($this->main_user->getId(), $following[0]->id);
    $this->assertFalse($following[0]->following);
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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('follow', array(), $this->additional_user->getId());
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

    lmbToolkit::instance()->setUser($this->main_user);
    $this->post('unfollow', array(), $this->additional_user->getId());
    $this->assertResponse(200);

    $this->assertEqual(0, $this->main_user->getFollowing()->count());
  }

  function testActivity()
  {
    $user = $this->generator->user();
    $user->save();
    $news1 = $this->generator->news($user);
    $news1->save();
    $news2 = $this->generator->news($user);
    $news2->save();
    $news3 = $this->generator->news($user);
    $news3->save();
    $news4 = $this->generator->news($user);
    $news4->save();
    $another_user_news = $this->generator->news();
    $another_user_news->save();

    lmbToolkit::instance()->setUser($this->main_user);
    $activities = $this->get('activity', array(), $user->id)->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($activities));
      $this->assertEqual($news4->exportForApi(), $activities[0]);
      $this->assertEqual($news3->exportForApi(), $activities[1]);
      $this->assertEqual($news2->exportForApi(), $activities[2]);
      $this->assertEqual($news1->exportForApi(), $activities[3]);
    }

    $activities = $this->get('activity', array('from' => $news4->id), $user->id)->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($activities));
      $this->assertEqual($news3->exportForApi(), $activities[0]);
      $this->assertEqual($news2->exportForApi(), $activities[1]);
      $this->assertEqual($news1->exportForApi(), $activities[2]);
    }

    $activities = $this
      ->get('activity', array(
        'from' => $news4->id,
        'to' => $news1->id
      ), $user->id)
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($activities));
      $this->assertEqual($news3->exportForApi(), $activities[0]);
      $this->assertEqual($news2->exportForApi(), $activities[1]);
    }

    $activities = $this
      ->get('activity', array(
      'from' => $news4->id,
      'to' => $news1->id,
      'limit' => 1
    ), $user->id)
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($activities));
      $this->assertEqual($news3->exportForApi(), $activities[0]);
    }
  }

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

    $users = $this->get('search', array('query' => 'foo'))->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(4, count($users));
      $this->assertEqual($user1->getId(), $users[0]->id);
      $this->assertEqual($user2->getId(), $users[1]->id);
      $this->assertEqual($user3->getId(), $users[2]->id);
      $this->assertEqual($user4->getId(), $users[3]->id);
    }

    $users = $this
      ->get('search', array('query' => 'foo', 'from' => $user1->getId()))
      ->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual(3, count($users));
      $this->assertEqual($user2->getId(), $users[0]->id);
      $this->assertEqual($user3->getId(), $users[1]->id);
      $this->assertEqual($user4->getId(), $users[2]->id);
    }

    $users = $this
      ->get('search', array(
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
      ->get('search', array(
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
