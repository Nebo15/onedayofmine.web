<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class UserAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('Day');
  }

  /**
   * @api
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
  	$this->assertEqual($day1->getId(), $days[0]->id);
  	$this->assertEqual($day2->getId(), $days[1]->id);
  }

  /**
   * @api
   */
  function testUserById()
  {
    $this->main_user->save();

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
   * @api
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
    $this->assertTrue($followers[0]->is_follower);
  }

  /**
   * @api
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
   * @api
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
    $this->assertTrue($following[0]->is_followed);
  }

  /**
   * @api
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
	 * @api
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
   * @api
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

  /**
	 * @api
	 */
  function testActivity() {}

  /**
	 * @api
	 */
  function testSearch() {}
}
