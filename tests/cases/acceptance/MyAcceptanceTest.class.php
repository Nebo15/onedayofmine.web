<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class MyAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('UserSettings');
  }

  /**
   * @api
   */
	function testProfile()
	{
		$this->main_user->save();
		$this->_loginAndSetCookie($this->main_user);

		$profile = $this->get('/my/profile')->result;
		if($this->assertResponse(200))
		{
			$this->assertEqual($this->main_user->id, $profile->id);
			// $this->assertEqual($this->main_user->ctime, $profile->ctime);
			// $this->assertEqual($this->main_user->utime, $profile->utime);
			$this->assertEqual($this->main_user->fb_uid, $profile->fb_uid);
			// $this->assertEqual($this->main_user->fb_profile_utime, $profile->fb_profile_utime);
			$this->assertEqual($this->main_user->first_name, $profile->first_name);
			$this->assertEqual($this->main_user->last_name, $profile->last_name);
			// $this->assertEqual($this->main_user->fb_profile_url, $profile->fb_profile_url);
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
	 * @api
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
   * @api
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
	 * @api
	 */
	function testSettings()
	{
    $this->main_user->save();

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(1);
    $settings->setNotificationsNewComments(0);
    $settings->setNotificationsRelatedActivity(1);
    $settings->setNotificationsShootingPhotos(0);
    $settings->setPhotosSaveOriginal(1);
    $settings->setPhotosSaveFiltered(0);

    $this->main_user->setSettings($settings);
    $this->main_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $settings = $this->get("/my/settings/")->result;

    $this->assertEqual(1, $settings->notifications_new_days);
    $this->assertEqual(0, $settings->notifications_new_comments);
    $this->assertEqual(1, $settings->notifications_related_activity);
    $this->assertEqual(0, $settings->notifications_shooting_photos);
    $this->assertEqual(1, $settings->photos_save_original);
    $this->assertEqual(0, $settings->photos_save_filtered);
	}
	/**
	 * @api
	 */
	function testUpdateSettings()
	{
    $this->main_user->save();

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(0);
    $settings->setNotificationsNewComments(0);
    $settings->setNotificationsRelatedActivity(0);
    $settings->setNotificationsShootingPhotos(0);
    $settings->setPhotosSaveOriginal(0);
    $settings->setPhotosSaveFiltered(0);

    $this->main_user->setSettings($settings);
    $this->main_user->save();

    $this->_loginAndSetCookie($this->main_user);

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(1);
    $settings->setNotificationsNewComments(1);
    $settings->setNotificationsRelatedActivity(1);
    $settings->setNotificationsShootingPhotos(1);
    $settings->setPhotosSaveOriginal(1);
    $settings->setPhotosSaveFiltered(1);

    $settings = $this->post("/my/settings/", $settings->export())->result;

    $this->assertEqual(1, $settings->notifications_new_days);
    $this->assertEqual(1, $settings->notifications_new_comments);
    $this->assertEqual(1, $settings->notifications_related_activity);
    $this->assertEqual(1, $settings->notifications_shooting_photos);
    $this->assertEqual(1, $settings->photos_save_original);
    $this->assertEqual(1, $settings->photos_save_filtered);
	}
}
