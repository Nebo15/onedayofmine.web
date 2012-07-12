<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class MyAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@public
   */
	function testProfile()
	{
		$this->main_user->save();
		$this->_loginAndSetCookie($this->main_user);

		$profile = $this->get('/my/profile')->result;
		if($this->assertResponse(200))
		{
			$this->assertEqual($this->main_user->id, $profile->id);
			$this->assertEqual($this->main_user->ctime, $profile->ctime);
			$this->assertEqual($this->main_user->utime, $profile->utime);
			$this->assertEqual($this->main_user->fb_uid, $profile->fb_uid);
			$this->assertEqual($this->main_user->fb_profile_utime, $profile->fb_profile_utime);
			$this->assertEqual($this->main_user->first_name, $profile->first_name);
			$this->assertEqual($this->main_user->last_name, $profile->last_name);
			$this->assertEqual($this->main_user->fb_profile_url, $profile->fb_profile_url);
			$this->assertEqual($this->main_user->timezone, $profile->timezone);
			$this->assertEqual($this->main_user->sex, $profile->sex);
			$this->assertEqual($this->main_user->fb_pic_small, $profile->fb_pic_small);
			$this->assertEqual($this->main_user->fb_pic_square, $profile->fb_pic_square);
			$this->assertEqual($this->main_user->fb_pic_big, $profile->fb_pic_big);
			$this->assertEqual($this->main_user->occupation, $profile->occupation);
      $this->assertEqual($this->main_user->location, $profile->location);
      $this->assertEqual($this->main_user->birthday, $profile->birthday);
		}
	}
	/**
	 * @public
	 */
	function testUpdateProfile()
	{
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

		$update = new stdClass();
		$update->first_name = $this->generator->string(25);
		$update->last_name = $this->generator->string(25);
		$update->occupation = $this->generator->string(25);
    $update->location = $this->generator->string(25);
    $update->birthday = $this->generator->date_sql();

    $updated_profile = $this->post('/my/profile', (array) $update)->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($update->first_name, $updated_profile->first_name);
      $this->assertEqual($update->last_name, $updated_profile->last_name);
      $this->assertEqual($update->occupation, $updated_profile->occupation);
      $this->assertEqual($update->location, $updated_profile->location);
      $this->assertEqual($update->birthday, $updated_profile->birthday);

      $loaded_user = User::findById($this->main_user->getId());

      $this->assertEqual($loaded_user->first_name, $updated_profile->first_name);
      $this->assertEqual($loaded_user->last_name, $updated_profile->last_name);
      $this->assertEqual($loaded_user->occupation, $updated_profile->occupation);
      $this->assertEqual($loaded_user->location, $updated_profile->location);
      $this->assertEqual($loaded_user->birthday, $updated_profile->birthday);
    }
	}

  /**
   * @public
   */
  function testUpdateProfile_Partial()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $update = new stdClass();
    $update->first_name = $this->generator->string(25);
    $update->birthday = $this->generator->date_sql();

    $updated_profile = $this->post('/my/profile', (array) $update)->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($update->first_name, $updated_profile->first_name);
      $this->assertEqual($update->birthday, $updated_profile->birthday);

      $loaded_user = User::findById($this->main_user->getId());

      $this->assertEqual($loaded_user->first_name, $updated_profile->first_name);
      $this->assertEqual($loaded_user->birthday, $updated_profile->birthday);
    }
  }
	/**
	 *@public
	 */
	function testSettings()
	{

	}
	/**
	 * @public
	 */
	function doUpdateSettings()
	{

	}
}
