<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class MyAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
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
		}
	}
	/**
	 * @example
	 */
	function doUpdateProfile()
	{
		$update = new stdClass();
		$update->first_name = $this->generator->string(25);
		$update->last_name = $this->generator->string(25);
		$update->occupation = $this->generator->string(25);
	}
	/**
	 *@example
	 */
	function testSettings()
	{

	}
	/**
	 * @example
	 */
	function doUpdateSettings()
	{

	}
}