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
   * @public
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
   * @public
   */
  function testFollowers()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $followers = $this->get('users/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(0, count($followers));

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->save();

    $followers = $this->get('users/followers')->result;
    $this->assertResponse(200);
    $this->assertEqual(1, count($followers));
    $this->assertEqual($this->additional_user->getId(), $followers[0]->id);
  }

  /**
   * @public
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
	 * @public
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
   * @public
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
	 * @public
	 */
  function testProfile() {}

  /**
	 * @public
	 */
  function testProfileUpdate() {}

  /**
	 * @public
	 */
  function testSettings() {}

  /**
	 * @public
	 */
  function testSettingsUpdate() {}

  /**
	 * @public
	 */
  function testActivity() {}

  /**
	 * @public
	 */
  function testSearch() {}
}
