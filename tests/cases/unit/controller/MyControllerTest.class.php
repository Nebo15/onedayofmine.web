<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MyController.class.php');

class MyControllerTest extends odControllerTestCase
{
  protected $controller_class = 'MyController';

  /**
   * @api description Returns <a href="#Entity:User">profile</a> of current logged in user.
   */
  function testProfile()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $profile = $this->get('profile')->result;
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
    lmbToolkit::instance()->setUser($this->main_user);

    $update = new stdClass();
    $update->name = $this->generator->string(25);
    $update->sex = User::SEX_FEMALE;
    $update->occupation = $this->generator->string(25);
    $update->location = $this->generator->string(25);
    $update->email = $this->generator->email();
    $update->birthday = $this->generator->date_sql();
    $update->image_content = base64_encode($this->generator->image());

    $updated_profile = $this->post('profile', $update)->result;
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
    lmbToolkit::instance()->setUser($this->main_user);

    $update = new stdClass();
    $update->name = $this->generator->string(25);
    $update->birthday = $this->generator->date_sql();

    $updated_profile = $this->post('profile', $update)->result;

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

    lmbToolkit::instance()->setUser($this->main_user);

    $settings = $this->get("settings")->result;

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
    $this->toolkit->setUser($this->main_user);

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(1);
    $settings->setNotificationsNewComments(1);
    $settings->setNotificationsNewReplays(1);
    $settings->setNotificationsRelatedActivity(1);
    $settings->setNotificationsShootingPhotos(1);
    $settings->setPhotosSaveOriginal(1);
    $settings->setPhotosSaveFiltered(1);
    $settings->setSocialShareFacebook(1);
    $settings->setSocialShareTwitter(1);

    $settings = $this->post("settings", $settings->export())->result;
    foreach($settings as $option => $value)
      $this->assertEqual(1, $value, "Error in $option. 1 != $value");

    $real_settings = $this->main_user->getSettings();
    $this->assertEqual($settings, $real_settings->exportForApi());

    $settings = new UserSettings();
    $settings->setNotificationsNewDays(0);
    $settings->setNotificationsNewComments(0);
    $settings->setNotificationsNewReplays(0);
    $settings->setNotificationsRelatedActivity(0);
    $settings->setNotificationsShootingPhotos(0);
    $settings->setPhotosSaveOriginal(0);
    $settings->setPhotosSaveFiltered(0);
    $settings->setSocialShareFacebook(0);
    $settings->setSocialShareTwitter(0);

    $this->toolkit->setUser($this->main_user);
    $settings = $this->post("settings", $settings->export())->result;

    foreach($settings as $option => $value)
      $this->assertEqual(0, $value, "Error in $option. 0 != $value");

    $real_settings_collection = UserSettings::find();
    $this->assertEqual(1, count($real_settings_collection));
    $this->assertEqual($settings, $real_settings_collection->at(0)->exportForApi());
  }

  /**
   * @api description Returns news for current logged in user.
   * @api input param int from
   * @api input param int to
   * @api input param int limit
   * @api result News[] - List of news. If you use the "from" option (wthout "to") and returned list is empty, than additionally HTTP 304 status code can be returned.
   */
  function testGetMyNews()
  {
    $this->main_user->save();
    $this->toolkit->setUser($this->main_user);

    $response = $this->get('news');
    $this->assertResponse(200);
    $this->assertEqual(0, count($response->result));

    // Adding new news
    $news1 = $this->generator->news(null, $this->main_user);
    $news1->save();
    $news2 = $this->generator->news(null, $this->main_user);
    $news2->save();
    $news3 = $this->generator->news(null, $this->main_user);
    $moment = $this->generator->moment();
    $moment->setDay($this->generator->day());
    $moment->save();
    $news3->setMoment($moment);
    $news3->save();
    $news4 = $this->generator->news($this->additional_user, $this->main_user);
    $news4->save();

    $response = $this->get('news');
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(4, count($response->result));
      $this->assertEqual($news4->getId(), $response->result[0]->id);
      $this->assertEqual($news3->getId(), $response->result[1]->id);
      $this->assertEqual($news2->getId(), $response->result[2]->id);
      $this->assertEqual($news1->getId(), $response->result[3]->id);
    }

    // If there are no new news return shoud be empty with HTTP 304 status code
    $response = $this->get('news', array('from' => $news1->getId()));
    $this->assertResponse(304);
    $this->assertEqual(0, count($response->result));

    $response = $this->get('news', array('from' => $news4->getId()));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(3, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
      $this->assertEqual($news1->getId(), $response->result[2]->id);
    }

    $response = $this->get('news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(2, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
    }

    $response = $this->get('news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
      'limit' => 1
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(1, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
    }
  }
}
