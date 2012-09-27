<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/model/Day.class.php');

class AuthControllerTest extends odControllerTestCase
{
  protected $controller_class = 'AuthController';

  /**
   * @api description Returns user authentication status.
   * @api result bool - TRUE if user is logged id, else - FALSE
   */
  function testIsLoggedIn()
  {
    $response = $this->get('is_logged_in', ['token' => $this->main_user->getFacebookAccessToken()]);
    if($this->assertResponse(200))
      $this->assertFalse($response->result);
  }

  /**
   * @api description Authorizes and returns User.
   * @api input param string[118] token Facebook access token
   */
  function testLogin()
  {
    $this->additional_user->save();
    $this->main_user->save();

    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $response = $this->post('login', array(
      'token'        => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ));

    if($this->assertResponse(200))
    {
      $user = $response->result;
      $this->assertJsonUser($user);

      $loaded_user = User::findById($user->id);
      $this->assertEqual($loaded_user->getFacebookAccessToken(), $this->additional_user->getFacebookAccessToken());

      $tokens = $loaded_user->getDeviceTokens();
      $this->assertEqual(1, count($tokens));
      $this->assertEqual($device_token, $tokens->at(0)->token);
    }
  }

  function testLogin_WithoutDeviceToken()
  {
    $this->additional_user->save();

    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $response = $this->post('login', array(
      'token' => $this->additional_user->getFacebookAccessToken(),
    ));

    if($this->assertResponse(200))
    {
      $user = $response->result;
      $this->assertJsonUser($user);

      $loaded_user = User::findById($user->id);
      $this->assertEqual($loaded_user->getFacebookAccessToken(), $this->additional_user->getFacebookAccessToken());

      $tokens = $loaded_user->getDeviceTokens();
      $this->assertEqual(0, count($tokens));
    }
  }

  function testLogin_AndSetCookie()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(200))
    {
      $response = $this->get('is_logged_in', [
        'token' => $this->main_user->getFacebookAccessToken()
      ]);

      if($this->assertResponse(200))
        $this->assertTrue($response->result);
    }
  }

  function testLogin_Session_ByGetParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(200))
    {
      $response = $this->get('is_logged_in', [
        'token' => $this->main_user->getFacebookAccessToken()
      ]);

      if($this->assertResponse(200))
        $this->assertTrue($response->result);
    }
  }

  function testLogin_Session_ByPostParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(200))
    {
      $response = $this->get('is_logged_in', [
        'token' => $this->main_user->getFacebookAccessToken()
      ]);

      if($this->assertResponse(200))
        $this->assertTrue($response->result);
    }
  }

  function testLogin_FirstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $info = $this->generator->facebookInfo($this->main_user->facebook_uid);

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->setReturnValue('getInfo', $info);
    $profile->setReturnValue('getRegisteredFriends', []);

    $this->post('login', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    $users = User::find();
    $this->assertEqual(1, count($users));

    $this->post('login', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(200))
    {
      $users = User::find();
      $this->assertEqual(1, count($users));
      $user = $this->toolkit->getExportHelper()->exportUser($users->at(0));
      $this->assertJsonUser($user);
    }
  }

  /**
   * @api
   */
  function testLogin_WrongAccessToken()
  {
    $this->cookies = [];

    $response = $this->post('login', [
      'token'        => 'wrong_access_token',
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(403))
    {
      $this->assertTrue(is_null($response->result));

      $errors = $response->errors;
      if($this->assertEqual(1, count($errors)))
        $this->assertEqual('Invalid OAuth access token.', $errors[0]);
    }
  }

  function testLogin_AccessTokenNotGiven()
  {
    $this->cookies = [];

    $response = $this->post('login', [
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(412))
    {
      $this->assertTrue(is_null($response->result));

      $errors = $response->errors;
      if($this->assertEqual(1, count($errors)))
        $this->assertEqual('Token not given', $errors[0]);
    }
  }

  function testLogin_FromSeveralDevices()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', array(
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token_1 = $this->generator->string(64)
    ));

    $this->post('login', array(
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token_2 = $this->generator->string(64)
    ));

    $tokens = $this->main_user->getDeviceTokens();
    if($this->assertEqual(2, count($tokens)))
    {
      $this->assertEqual($device_token_1, $tokens->at(0)->token);
      $this->assertEqual($device_token_2, $tokens->at(1)->token);
    }
  }

  function testLogin_DeviceOwnerChanged()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->additional_user->save();
    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $device_token = $this->generator->string(64);

    $this->post('login', array(
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token
    ));

    $this->post('login', array(
      'token'        => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $device_token
    ));

    $tokens = $this->main_user->getDeviceTokens();
    $this->assertEqual(0, count($tokens));

    $tokens = $this->additional_user->getDeviceTokens();
    if($this->assertEqual(1, count($tokens)))
      $this->assertEqual($device_token, $tokens->at(0)->token);
  }

  function testLogin_FirstCallCreateNewUserWithDefaultAvatar()
  {
    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $profile = $this->toolkit->getFacebookProfile($this->additional_user);
    $facebook_info = $this->generator->facebookInfo($this->additional_user->facebook_uid);
    $facebook_info['pic'] = 'http://fb.com/default_image.gif';
    $profile->setReturnValue('getInfo', $facebook_info);
    $profile->setReturnValue('getRegisteredFriends', []);

    $this->post('login', [
      'token'        => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    $users = User::find();
    if($this->assertEqual(1, count($users)))
      $this->assertJsonUser($this->toolkit->getExportHelper()->exportUser($users->at(0)));
  }

  function testLogin_TokenLengthGreaterThan128()
  {
    $this->get('is_logged_in', [
      'token' => $this->generator->string(200)
    ]);
    $this->assertResponse(200);
  }

  function testLogout()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('logout', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $this->generator->string()
    ]);

    if($this->assertResponse(200))
    {
      $response = $this->get('is_logged_in', [
        'token' => $this->main_user->getFacebookAccessToken()
      ]);

      if($this->assertResponse(200))
        $this->assertFalse($response->result);
    }
  }

  function testLogout_RemoveDeviceToken()
  {
    $device_token = $this->generator->string();

    $this->main_user->addToDeviceTokens(new DeviceToken(['token' => $device_token]));
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('logout', [
      'token'        => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token
    ]);

    if($this->assertResponse(200))
      $this->assertEqual(0, count($this->main_user->getDeviceTokens()));
  }
}
