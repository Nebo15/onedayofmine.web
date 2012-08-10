<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/tools/odTools.class.php');

class odToolsTest extends odUnitTestCase
{
  function testGetFacebookProfile()
  {
    $user = new User();
    $user->setFbAccessToken($this->generator->string(11));

    $profile = (new odTools())->getFacebookProfile($user);

    $this->assertEqual('FacebookProfile', get_class($profile));
  }

  function testGetFacebookProfile_Fake()
  {
    $user = new User();
    $settings = new UserSettings();
    $settings->setSocialShareFacebook(0);
    $user->setSettings($settings);
    $user->setFbAccessToken($this->generator->string(11));

    $profile = (new odTools())->getFacebookProfile($user);

    $this->assertEqual('FakeProfile', get_class($profile));
  }

  function testGetTwitterProfile()
  {
    $user = new User();
    $user->setTwitterAccessToken($this->generator->string(11));
    $user->setTwitterAccessTokenSecret($this->generator->string(11));

    $profile = (new odTools())->getTwitterProfile($user);

    $this->assertEqual('TwitterProfile', get_class($profile));
  }

  function testGetTwitterProfile_Fake()
  {
    $user = new User();
    $settings = new UserSettings();
    $settings->setSocialShareTwitter(0);
    $user->setSettings($settings);

    $profile = (new odTools())->getTwitterProfile($user);

    $this->assertEqual('FakeProfile', get_class($profile));
  }
}
