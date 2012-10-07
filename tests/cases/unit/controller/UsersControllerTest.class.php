<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/UsersController.class.php');
lmb_require('src/model/Day.class.php');

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
    $this->additional_user->save();

    $day1 = $this->generator->day($this->main_user);
    $day1->save();
    $day2 = $this->generator->day($this->main_user);
    $day2->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->get('days', [], $this->main_user->getId());
    if($this->assertResponse(200))
    {
      $response_days = $response->result;
      $this->assertEqual(2, count($response_days));
      $this->assertJsonDayItems($response_days);

      $this->assertEqual($day2->getId(), $response_days[0]->id);
      $this->assertEqual($day1->getId(), $response_days[1]->id);
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

    $response = $this->get('item', [], $this->main_user->getId());
    if($this->assertResponse(200))
    {
      $response_user = $response->result;
      $this->assertJsonUser($response_user);

      $user = User::findById($this->main_user->getId())->exportForApi();
      $this->assertEqualPropertyValues($response_user, $user);

      $this->assertEqual($user->id, $response_user->id);
      $this->assertTrue($response_user->following);
    }
  }

  function testEmptyFollowers()
  {
    $this->main_user->save();
    $this->additional_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
    {
      $followers = $response->result;
      $this->assertEqual(0, count($followers));
    }
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

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
      $this->assertEqual(0, count($response->result));

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->add($third_user);
    $followers->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
    {
      $response_followers = $response->result;
      $this->assertEqual(2, count($response_followers));
      $this->assertJsonUserItems($response_followers);

      $this->assertTrue($response_followers[0]->following);
      $this->assertTrue($response_followers[1]->following);

      $this->assertEqual($this->additional_user->getId(), $response_followers[0]->id);
      $this->assertEqual($third_user->getId(), $response_followers[1]->id);
    }
  }

  function testFollowers_anotherUser()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
      $this->assertEqual(0, count($response->result));

    $followers = $this->additional_user->getFollowers();
    $followers->add($third_user);
    $followers->add($this->main_user);
    $followers->save();

    $followers = $this->main_user->getFollowers();
    $followers->add($third_user);
    $followers->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('followers', [], $this->additional_user->getId());
    if($this->assertResponse(200))
    {
      $response_followers = $response->result;
      $this->assertEqual(2, count($response_followers));
      $this->assertJsonUserItems($response_followers);

      $this->assertFalse($response_followers[0]->following);
      $this->assertTrue($response_followers[1]->following);

      $this->assertEqual($this->main_user->getId(), $response_followers[0]->id);
      $this->assertEqual($third_user->getId(), $response_followers[1]->id);
    }
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

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
      $this->assertEqual(0, count($response->result));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->add($third_user);
    $following->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('following', [], $this->main_user->getId());
    if($this->assertResponse(200))
    {
      $response_following = $response->result;
      $this->assertEqual(2, count($response_following));
      $this->assertJsonUserItems($response_following);

      $this->assertEqual($this->additional_user->getId(), $response_following[0]->id);

      $this->assertTrue($response_following[0]->following);
      $this->assertFalse($response_following[1]->following);
    }
  }

  function testFollowing_anotherUser()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $third_user = $this->generator->user('Dum Dum');
    $third_user->save();

    $this->toolkit->setUser($this->additional_user);

    $response = $this->get('followers', [], $this->main_user->getId());
    if($this->assertResponse(200))
      $this->assertEqual(0, count($response->result));

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->add($third_user);
    $following->save();

    $following = $this->additional_user->getFollowing();
    $following->add($this->main_user);
    $following->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $response = $this->get('following', [], $this->additional_user->getId());
    if($this->assertResponse(200))
    {
      $response_following = $response->result;
      $this->assertEqual(1, count($response_following));
      $this->assertJsonUserItems($response_following);

      $this->assertEqual($this->main_user->getId(), $response_following[0]->id);

      $this->assertFalse($response_following[0]->following);
    }
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

    $response = $this->post('follow', [], $this->additional_user->getId());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(1, $this->main_user->getFollowing()->count());
    }
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

    $response = $this->post('unfollow', [], $this->additional_user->getId());
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(0, $this->main_user->getFollowing()->count());
    }
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

    $response = $this->get('activity', [], $user->id);
    if($this->assertResponse(200))
    {
      $response_activities = $response->result;
      $this->assertEqual(4, count($response_activities));
      $this->assertJsonNewsItems($response_activities);

      $this->assertEqual($news4->exportForApi(), $response_activities[0]);
      $this->assertEqual($news3->exportForApi(), $response_activities[1]);
      $this->assertEqual($news2->exportForApi(), $response_activities[2]);
      $this->assertEqual($news1->exportForApi(), $response_activities[3]);
    }

    $response_with_from = $this->get('activity', [
      'from' => $news4->id
    ], $user->id);
    if($this->assertResponse(200))
    {
      $response_activities = $response_with_from->result;
      $this->assertEqual(3, count($response_activities));
      $this->assertJsonNewsItems($response_activities);

      $this->assertEqual($news3->exportForApi(), $response_activities[0]);
      $this->assertEqual($news2->exportForApi(), $response_activities[1]);
      $this->assertEqual($news1->exportForApi(), $response_activities[2]);
    }

    $response_with_range = $this->get('activity', [
      'from' => $news4->id,
      'to'   => $news1->id,
    ], $user->id);
    if($this->assertResponse(200))
    {
      $response_activities = $response_with_range->result;
      $this->assertEqual(2, count($response_activities));
      $this->assertJsonNewsItems($response_activities);

      $this->assertEqual($news3->exportForApi(), $response_activities[0]);
      $this->assertEqual($news2->exportForApi(), $response_activities[1]);
    }

    $response_with_limit = $this->get('activity', [
      'from' => $news4->id,
      'to' => $news1->id,
      'limit' => 1
    ], $user->id);
    if($this->assertResponse(200))
    {
      $response_activities = $response_with_limit->result;
      $this->assertEqual(1, count($response_activities));
      $this->assertJsonNewsItems($response_activities);

      $this->assertEqual($news3->exportForApi(), $response_activities[0]);
    }
  }

  /**
   * @api
   */
  function testSearch()
  {
    $user1 = $this->generator->user();
    $user1->setName('John Doe');
    $user1->save();
    $user2 = $this->generator->user();
    $user2->setName('John Watson');
    $user2->save();
    $user3 = $this->generator->user();
    $user3->setName('Johnnie Cheeze');
    $user3->save();
    $user4 = $this->generator->user();
    $user4->setName('John John');
    $user4->save();
    $user5 = $this->generator->user();
    $user5->setName('Mike Jameson');
    $user5->save();

    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");
    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response->result;
      $this->assertEqual(4, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user1->getId(), $response_users[0]->id);
      $this->assertEqual($user2->getId(), $response_users[1]->id);
      $this->assertEqual($user3->getId(), $response_users[2]->id);
      $this->assertEqual($user4->getId(), $response_users[3]->id);
    }

    $response_with_from = $this->get('search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_from->result;
      $this->assertEqual(3, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
      $this->assertEqual($user3->getId(), $response_users[1]->id);
      $this->assertEqual($user4->getId(), $response_users[2]->id);
    }

    $response_with_range = $this->get('search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
      'to'    => $user4->getId(),
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_range->result;
      $this->assertEqual(2, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
      $this->assertEqual($user3->getId(), $response_users[1]->id);
    }

    $response_with_limit = $this->get('search', [
      'query' => 'John*',
      'from'  => $user1->getId(),
      'to'    => $user4->getId(),
      'limit' => 1,
    ]);
    if($this->assertResponse(200))
    {
      $response_users = $response_with_limit->result;
      $this->assertEqual(1, count($response_users));
      $this->assertJsonUserItems($response_users);

      $this->assertEqual($user2->getId(), $response_users[0]->id);
    }
  }

  function testSearch_IndexUpdatedFromDeltaIndex()
  {
    $sphinx_config = lmbToolkit::instance()->getConf('sphinx');
    lmb_assert_true(array_key_exists('config_file_path', $sphinx_config), 'Sphinx config file not set. Check config.');
    lmb_assert_true($sphinx_config['config_file_path'], 'Sphinx config file path is emprty. Check config.');
    lmb_assert_true(file_exists($sphinx_config['config_file_path']), "Sphinx config file '{$sphinx_config['config_file_path']}' not found. Check config.");

    $user1 = $this->generator->user();
    $user1->setName('John Doe');
    $user1->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(1, count($response->result));
      $this->assertJsonUserItems($response->result);
    }

    $user2 = $this->generator->user();
    $user2->setName('John Watson');
    $user2->save();

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate users_delta --quiet"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    if($result = exec("indexer --config {$sphinx_config['config_file_path']} --rotate --quiet --merge users users_delta"))
    {
      $this->fail("Indexer returned errors or/and warnings: {$result}");
      return;
    }
    sleep(1);

    $response = $this->get('search', [
      'query' => 'John*'
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(2, count($response->result));
      $this->assertJsonUserItems($response->result);
    }
  }
}
