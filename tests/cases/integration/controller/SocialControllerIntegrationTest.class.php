<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class SocialControllerIntegrationTest extends odIntegrationTestCase
{
  function setUp()
  {
    parent::setUp();
    $this->main_user->getSettings()->social_share_facebook = 1;
    $this->additional_user->getSettings()->social_share_facebook = 1;
  }

  /**
   * @api
   */
  function testFacebookFiends()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->_login($this->main_user);

    $response = $this->get('social/facebook_friends');
    if($this->assertResponse(200))
    {
      $friends = $response->result;
      $this->assertTrue(is_array($friends));
      $this->assertEqual(1, count($friends));
      $this->assertEqual($friends[0]->uid, $this->additional_user->facebook_uid);
      $this->assertJsonFacebookUserItems($friends, true);
    }
  }

  function testFacebookFiends_following()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $this->generator->follow($this->additional_user, $this->main_user);

    $this->_login($this->main_user);

    $response = $this->get('social/facebook_friends');
    if($this->assertResponse(200))
    {
      $friends = $response->result;
      $this->assertTrue(is_array($friends));
      $this->assertEqual(1, count($friends));
      $this->assertEqual($friends[0]->uid, $this->additional_user->facebook_uid);
      $this->assertTrue($friends[0]->user->following);
      $this->assertJsonFacebookUserItems($friends, true);
    }
  }

  function testFacebookFiends_notRegisteredUser()
  {
    $additional_user_facebook_uid = $this->additional_user->facebook_uid;
    $this->additional_user->destroy();
    $this->main_user->save();

    $this->_login($this->main_user);

    $response = $this->get('social/facebook_friends');
    if($this->assertResponse(200))
    {
      $friends = $response->result;
      $this->assertTrue(is_array($friends));
      $this->assertEqual(1, count($friends));
      $this->assertEqual($friends[0]->uid, $additional_user_facebook_uid);
      $this->assertEqual(null, $friends[0]->user);
      $this->assertJsonFacebookUserItems($friends, true);
    }
  }

  function testFacebookInvite()
  {
    $additional_user_facebook_uid = $this->additional_user->facebook_uid;
    $this->additional_user->destroy();
    $this->main_user->save();

    $this->_login($this->main_user);

    $response = $this->post('social/facebook_invite', [
      'uid' => $additional_user_facebook_uid,
    ]);
    if($this->assertResponse(200))
    {
      $this->assertEqual(null, $response->result);
    }
  }

  /**
   * @api
   */
  function testTwitterConnect()
  {
    $this->main_user->getSettings()->social_share_twitter = 1;
    $this->main_user->save();
    $this->_login($this->main_user);
    $result = $this->post('social/twitter_connect', array(
      'access_token'         => $this->generator->twitter_credentials()[0]['access_token'],
      'access_token_secret'  => $this->generator->twitter_credentials()[0]['access_token_secret']
    ));
    $user = User::findById($this->main_user->id);
    if($this->assertResponse(200)) {
      $this->assertEqual($user->twitter_uid, $this->generator->twitter_credentials()[0]['uid']);
      $this->assertEqual($user->twitter_access_token, $this->generator->twitter_credentials()[0]['access_token']);
      $this->assertEqual($user->twitter_access_token_secret, $this->generator->twitter_credentials()[0]['access_token_secret']);
      $this->assertEqual(1, $user->getSettings()->social_share_twitter);
    }
  }

  function testTwitterConnect_withUnvalidCredentials()
  {
    $this->main_user->save();

    $this->_login($this->main_user);

    $response = $this->post('social/twitter_connect', array(
      'access_token'         => 'Wrong twitter access token',
      'access_token_secret'  => 'Wrong twitter access token secret'
    ));
    if($this->assertResponse(400))
    {
      $this->assertTrue(is_null($response->result));
      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0]->message, 'Twitter API exception: Invalid / expired Token.');
    }
  }

  function testTwitterConnect_WithNoField()
  {
    $this->main_user->save();

    $this->_login($this->main_user);

    $response = $this->post('social/twitter_connect', array(
      'access_token' => $this->generator->twitter_credentials()[0]['access_token']
    ));
    if($this->assertResponse(400))
    {
      $this->assertTrue(is_null($response->result));

      $this->assertEqual(count($response->errors), 1);
      $this->assertEqual($response->errors[0]->message, "Property 'access_token_secret' not found in request");
    }
  }

  /**
   * TODO
   */
  function testEmailInvite() {}
}
