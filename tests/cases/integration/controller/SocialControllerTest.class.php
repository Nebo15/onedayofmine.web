<?php
lmb_require('tests/cases/integration/odAcceptanceTestCase.class.php');

class SocialControllerTest extends odAcceptanceTestCase
{
  protected $controller_class = 'SocialController';

  function setUp()
  {
    parent::setUp();
    $this->main_user->getSettings()->setSocialShareFacebook(1);
    $this->additional_user->getSettings()->setSocialShareFacebook(1);
  }
  /**
   * @api
   */
  function testFacebookFiends()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $result = $this->get('social/facebook_friends');
    $friends = $result->result;
    $this->assertResponse(200);
    $this->assertTrue(is_array($friends));
    $this->assertEqual(1, count($friends));
    $this->assertEqual($friends[0]->fb_uid, $this->additional_user->getFbUid());
  }

  /**
   * example
   * TODO
   */
  function testFacebookInvite() {}

  /**
   * @api
   */
  function testTwitterConnect()
  {
    $this->main_user->getSettings()->setSocialShareTwitter(1);
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => $this->generator->twitter_credentials()[0]['access_token'],
      'access_token_secret'  => $this->generator->twitter_credentials()[0]['access_token_secret']
    ));
    $user = User::findById($this->main_user->id);
    if($this->assertResponse(200)) {
      $this->assertEqual($result->result->twitter_uid, $user->getTwitterUid());
      $this->assertEqual($user->getTwitterUid(), $this->generator->twitter_credentials()[0]['uid']);
      $this->assertEqual($user->getTwitterAccessToken(), $this->generator->twitter_credentials()[0]['access_token']);
      $this->assertEqual($user->getTwitterAccessTokenSecret(), $this->generator->twitter_credentials()[0]['access_token_secret']);
      $this->assertEqual(1, $user->getSettings()->getSocialShareTwitter());
    }
  }

  function testTwitterConnect_withUnvalidCredentials()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => 'Wrong twitter access token',
      'access_token_secret'  => 'Wrong twitter access token secret'
    ));
    if($this->assertResponse(403)) {
      $this->assertEqual($result->errors[0]->message, 'Twitter API exception: Invalid / expired Token.');
    }
  }

  function testTwitterConnect_withNoField()
  {
    $this->main_user->save();
    $this->_loginAndSetCookie($this->main_user);
    $this->post('social/twitter_connect', array(
      'access_token'         => $this->generator->twitter_credentials()[0]['access_token']
    ));
    $this->assertResponse(400);
  }

  /**
   * example
   * TODO
   */
  function testEmailInvite() {}
}
