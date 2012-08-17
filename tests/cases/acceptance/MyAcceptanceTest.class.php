<?php
lmb_require('tests/cases/acceptance/odAcceptanceTestCase.class.php');

class MyAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('UserSettings');
  }

  /**
   * @api description Returns <a href="#Entity:User">profile</a> of current logged in user.
   */
  function testProfile()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $profile = $this->get('/my/profile')->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual($this->main_user->id, $profile->id);
      $this->assertEqual($this->main_user->name, $profile->name);
      $this->assertEqual($this->main_user->email, $profile->email);
      $this->assertEqual($this->main_user->sex, $profile->sex);
      $this->assertProperty($profile, 'image_36');
      $this->assertProperty($profile, 'image_72');
      $this->assertEqual($this->main_user->occupation, $profile->occupation);
      $this->assertEqual($this->main_user->location, $profile->location);
      $this->assertEqual($this->main_user->birthday, $profile->birthday);
      $this->assertEqual($this->main_user->getFollowers()->count(), $profile->followers_count);
      $this->assertEqual($this->main_user->getFollowing()->count(), $profile->following_count);
      $this->assertEqual($this->main_user->getFavouriteDays()->count(), $profile->favourites_count);
      $this->assertEqual($this->main_user->getDays()->count(), $profile->days_count);
    }
  }

  /**
   * @api description Changes fields of current user <a href="#Entity:User">profile</a> and returns them (with new values). You are free to make selective changes.
   */
  function testUpdateProfile()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $update = new stdClass();
    $update->name = $this->generator->string(25);
    $update->sex = User::SEX_FEMALE;
    $update->occupation = $this->generator->string(25);
    $update->location = $this->generator->string(25);
    $update->email = $this->generator->email();
    $update->birthday = $this->generator->date_sql();
    $update->image_content = base64_encode($this->generator->image());

    $updated_profile = $this->post('/my/profile', (array) $update)->result;
    if($this->assertResponse(200))
    {
      $this->assertEqual($update->name, $updated_profile->name);
      $this->assertEqual($update->sex, $updated_profile->sex);
      $this->assertEqual($update->occupation, $updated_profile->occupation);
      $this->assertEqual($update->location, $updated_profile->location);
      $this->assertEqual($update->birthday, $updated_profile->birthday);
      $this->assertEqual($update->email, $updated_profile->email);
      $this->assertValidImageUrl($updated_profile->image_36);
      $this->assertValidImageUrl($updated_profile->image_72);

      $loaded_user = User::findById($this->main_user->getId());

      $this->assertEqual($loaded_user->name, $updated_profile->name);
      $this->assertEqual($loaded_user->occupation, $updated_profile->occupation);
      $this->assertEqual($loaded_user->location, $updated_profile->location);
      $this->assertEqual($loaded_user->birthday, $updated_profile->birthday);
      $this->assertEqual($loaded_user->email, $updated_profile->email);
    }
  }

  function testUpdateProfile_Partial()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $update = new stdClass();
    $update->name = $this->generator->string(25);
    $update->birthday = $this->generator->date_sql();

    $updated_profile = $this->post('/my/profile', (array) $update)->result;

    if($this->assertResponse(200))
    {
      $this->assertEqual($update->name, $updated_profile->name);
      $this->assertEqual($update->birthday, $updated_profile->birthday);

      $loaded_user = User::findById($this->main_user->getId());

      $this->assertEqual($loaded_user->name, $updated_profile->name);
      $this->assertEqual($loaded_user->birthday, $updated_profile->birthday);
    }
  }
  /**
   * @api Returns setting of current user.
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
   * @api Changes fields of current <a href="#Entity:UserSettings">user settings</a> and returns them (with new values). You are free to make selective changes.
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
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(0);

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
    $settings->setSocialShareFacebook(1);
    $settings->setSocialShareTwitter(1);

    $settings = $this->post("/my/settings/", $settings->export())->result;

    $this->assertEqual(1, $settings->notifications_new_days);
    $this->assertEqual(1, $settings->notifications_new_comments);
    $this->assertEqual(1, $settings->notifications_related_activity);
    $this->assertEqual(1, $settings->notifications_shooting_photos);
    $this->assertEqual(1, $settings->photos_save_original);
    $this->assertEqual(1, $settings->photos_save_filtered);
    $this->assertEqual(1, $settings->social_share_facebook);
    $this->assertEqual(1, $settings->social_share_twitter);

    $real_settings = UserSettings::findOne();
    $this->assertEqual($real_settings->getNotificationsNewDays(), $settings->notifications_new_days);
    $this->assertEqual($real_settings->getNotificationsNewComments(), $settings->notifications_new_comments);
    $this->assertEqual($real_settings->getNotificationsRelatedActivity(), $settings->notifications_related_activity);
    $this->assertEqual($real_settings->getNotificationsShootingPhotos(), $settings->notifications_shooting_photos);
    $this->assertEqual($real_settings->getPhotosSaveOriginal(), $settings->photos_save_original);
    $this->assertEqual($real_settings->getPhotosSaveFiltered(), $settings->photos_save_filtered);
    $this->assertEqual($real_settings->getSocialShareFacebook(), $settings->social_share_facebook);
    $this->assertEqual($real_settings->getSocialShareTwitter(), $settings->social_share_twitter);

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(0);
    $settings->setNotificationsNewComments(0);
    $settings->setNotificationsRelatedActivity(0);
    $settings->setNotificationsShootingPhotos(0);
    $settings->setPhotosSaveOriginal(0);
    $settings->setPhotosSaveFiltered(0);
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(0);

    $settings = $this->post("/my/settings/", $settings->export())->result;

    $this->assertEqual(0, $settings->notifications_new_days);
    $this->assertEqual(0, $settings->notifications_new_comments);
    $this->assertEqual(0, $settings->notifications_related_activity);
    $this->assertEqual(0, $settings->notifications_shooting_photos);
    $this->assertEqual(0, $settings->photos_save_original);
    $this->assertEqual(0, $settings->photos_save_filtered);
    $this->assertEqual(0, $settings->social_share_facebook);
    $this->assertEqual(0, $settings->social_share_twitter);

    $real_settings_collection = UserSettings::find();
    $this->assertEqual($real_settings_collection->count(), 1);
    $this->assertEqual($real_settings_collection->at(0)->getNotificationsNewDays(), $settings->notifications_new_days);
    $this->assertEqual($real_settings_collection->at(0)->getNotificationsNewComments(), $settings->notifications_new_comments);
    $this->assertEqual($real_settings_collection->at(0)->getNotificationsRelatedActivity(), $settings->notifications_related_activity);
    $this->assertEqual($real_settings_collection->at(0)->getNotificationsShootingPhotos(), $settings->notifications_shooting_photos);
    $this->assertEqual($real_settings_collection->at(0)->getPhotosSaveOriginal(), $settings->photos_save_original);
    $this->assertEqual($real_settings_collection->at(0)->getPhotosSaveFiltered(), $settings->photos_save_filtered);
    $this->assertEqual($real_settings_collection->at(0)->getSocialShareFacebook(), $settings->social_share_facebook);
    $this->assertEqual($real_settings_collection->at(0)->getSocialShareTwitter(), $settings->social_share_twitter);
  }
}
