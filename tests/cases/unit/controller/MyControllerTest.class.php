<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/MyController.class.php');
lmb_require('src/model/Day.class.php');

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
      $this->assertJsonUser($profile);
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

    $response = $this->post('profile', $update);
    if($this->assertResponse(200))
    {
      $updated_profile = $response->result;
      $this->assertEqualPropertyValues($updated_profile, $update);

      $loaded_profile = User::findFirst()->exportForApi();
      $this->assertEqualPropertyValues($loaded_profile, $update);
    }
  }

  function testUpdateProfile_Partial()
  {
    $this->main_user->save();
    lmbToolkit::instance()->setUser($this->main_user);

    $update = new stdClass();
    $update->name = $this->generator->string(25);
    $update->birthday = $this->generator->date_sql();

    $response = $this->post('profile', $update);

    if($this->assertResponse(200))
    {
      $updated_profile = $response->result;
      $this->assertEqualPropertyValues($updated_profile, $update);

      $loaded_profile = User::findFirst()->exportForApi();
      $this->assertEqualPropertyValues($loaded_profile, $update);
    }
  }

  /**
   * @api Returns setting of current user.
   */
  function testSettings()
  {
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

    $response = $this->get("settings");
    if($this->assertResponse(200))
    {
      $settings_exported = $settings->exportForApi();

      $updated_settings = $response->result;
      $this->assertJsonUserSettings($updated_settings);
      $this->assertEqualPropertyValues($updated_settings, $settings_exported);
    }
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

    $response = $this->post("settings", $settings->export());
    if($this->assertResponse(200))
    {
      $settings_exported = $settings->exportForApi();

      $updated_settings = $response->result;
      $this->assertJsonUserSettings($updated_settings);
      $this->assertEqualPropertyValues($updated_settings, $settings_exported);

      $loaded_settings = $this->main_user->getSettings()->exportForApi();
      $this->assertEqualPropertyValues($loaded_settings, $settings_exported);
    }

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

    $response = $this->post("settings", $settings->export());
    if($this->assertResponse(200))
    {
      $settings_exported = $settings->exportForApi();

      $updated_settings = $response->result;
      $this->assertJsonUserSettings($updated_settings);
      $this->assertEqualPropertyValues($updated_settings, $settings_exported);

      $loaded_settings = $this->main_user->getSettings()->exportForApi();
      $this->assertEqualPropertyValues($loaded_settings, $settings_exported);
    }
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

    // News are empty
    $response = $this->get('news');
    if($this->assertResponse(200))
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
      $json_news = $response->result;
      $this->assertTrue(is_array($json_news));
      $this->assertEqual(4, count($json_news));

      $this->assertJsonNewsItems($json_news);

      $this->assertEqual($news4->id, $json_news[0]->id);
      $this->assertEqual($news3->id, $json_news[1]->id);
      $this->assertEqual($news2->id, $json_news[2]->id);
      $this->assertEqual($news1->id, $json_news[3]->id);
    }

    // If there are no new news return shoud be empty with HTTP 304 status code
    $response = $this->get('news', [
      'from' => $news1->id
    ]);
    if($this->assertResponse(304))
      $this->assertEqual(0, count($response->result));

    $response = $this->get('news', [
      'from' => $news4->id
    ]);
    if($this->assertResponse(200))
    {
      $json_news = $response->result;
      $this->assertTrue(is_array($json_news));
      $this->assertEqual(3, count($json_news));

      $this->assertJsonNewsItems($json_news);

      $this->assertEqual($news3->id, $json_news[0]->id);
      $this->assertEqual($news2->id, $json_news[1]->id);
      $this->assertEqual($news1->id, $json_news[2]->id);
    }

    $response = $this->get('news', array(
      'from' => $news4->id,
      'to' => $news1->id,
    ));
    if($this->assertResponse(200))
    {
      $json_news = $response->result;
      $this->assertTrue(is_array($json_news));
      $this->assertEqual(2, count($json_news));

      $this->assertJsonNewsItems($json_news);

      $this->assertEqual($news3->id, $json_news[0]->id);
      $this->assertEqual($news2->id, $json_news[1]->id);
    }

    $response = $this->get('news', array(
      'from' => $news4->id,
      'to' => $news1->id,
      'limit' => 1
    ));
    if($this->assertResponse(200))
    {
      $json_news = $response->result;
      $this->assertTrue(is_array($json_news));
      $this->assertEqual(1, count($json_news));

      $this->assertJsonNewsItems($json_news);

      $this->assertEqual($news3->id, $response->result[0]->id);
    }
  }
}
