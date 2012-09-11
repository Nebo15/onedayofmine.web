<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');

class AuthControllerTest extends odControllerTestCase
{
  protected $controller_class = 'AuthController';

  /**
   * @api description Returns user authentication status.
   * @api result bool - TRUE if user is logged id, else - FALSE
   */
  function testIsLoggedIn()
  {
    $res = $this->get('is_logged_in', ['token' => $this->main_user->getFacebookAccessToken()]);
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }

  /**
   * @api description Authorizes and returns User.
   * @api input param string[118] token Facebook access token
   */
  function testLogin()
  {
    $this->additional_user->save();
    $this->main_user->save();

    $following = $this->main_user->getFollowing();
    $following->add($this->additional_user);
    $following->save();

    $followers = $this->main_user->getFollowers();
    $followers->add($this->additional_user);
    $followers->save();

    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $res = $this->post('login', array(
      'token' => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ))->result;

    if($this->assertResponse(200))
    {
      $loaded_user = User::findById($res->id);
      $this->assertValidUserJson($loaded_user, $res);
      $this->assertEqual($loaded_user->getFavouriteDays()->count(), $res->favourites_count);
      $this->assertEqual($loaded_user->getEmail(), $res->email);

      $tokens = $loaded_user->getDeviceTokens();
      $this->assertEqual(1, count($tokens));
      $this->assertEqual($device_token, $tokens->at(0)->token);
    }
  }

  function testLogin_AndSetCookie()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);
    $res = $this->get('is_logged_in', [
      'token' => $this->main_user->getFacebookAccessToken()
    ]);
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByGetParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);
    $res = $this->get('is_logged_in', array('token' => $this->main_user->getFacebookAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByPostParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);
    $res = $this->get('is_logged_in', array('token' => $this->main_user->getFacebookAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->setReturnValue('getInfo', $info = $this->generator->facebookInfo($this->main_user->facebook_uid));
    $profile->setReturnValue('getRegisteredFriends', array());

    $this->post('login', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);

    $users = User::find();
    $this->assertEqual(1, count($users));

    $this->post('login', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);

    $users = User::find();
    if($this->assertEqual(1, count($users)))
    {
      $user = $users->at(0)->exportForApi();
      $this->assertTrue($user->image_36);
      $this->assertTrue($user->image_72);
    }
  }

  /**
   * @api
   */
  function testLogin_WrongAccessToken()
  {
    $this->cookies = array();
    $result = $this->post('login', [
      'token' => 'Wrong_access_token',
      'device_token' => $device_token = $this->generator->string(64)
    ]);
    $errors = $result->errors;
    $this->assertResponse(403);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Invalid OAuth access token.', $errors[0]);
  }


  function testLogin_AccessTokenNotGiven()
  {
    $this->cookies = array();
    $errors = $this->post('login', ['device_token' => $this->generator->string(64)])->errors;
    $this->assertResponse(412);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Token not given', $errors[0]);
  }

  function testLogin_ApnsTokenNotGiven()
  {
    $this->cookies = array();
    $errors = $this->post('login', ['token' => $this->main_user->getFacebookAccessToken()])->errors;
    $this->assertResponse(412);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('APNS token not given', $errors[0]);
  }

  function testLogin_AddSecondDeviceToken()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->post('login', array(
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token_1 = $this->generator->string(64)
    ))->result;

    $this->post('login', array(
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token_2 = $this->generator->string(64)
    ))->result;

    $tokens = $this->main_user->getDeviceTokens();
    if($this->assertEqual(2, count($tokens)))
    {
      $this->assertEqual($device_token_1, $tokens->at(0)->token);
      $this->assertEqual($device_token_2, $tokens->at(1)->token);
    }
  }

  function testLogin_ReplaceTokenUser()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFacebookUid());

    $this->additional_user->save();
    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $this->post('login', array(
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ))->result;

    $this->post('login', array(
      'token' => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $device_token
    ))->result;

    $tokens = $this->main_user->getDeviceTokens();
    $this->assertEqual(0, count($tokens));

    $tokens = $this->additional_user->getDeviceTokens();
    if($this->assertEqual(1, count($tokens)))
    {
      $this->assertEqual($device_token, $tokens->at(0)->token);
    }
  }

  function testLogin_firstCallCreateNewUserWithDefaultAvatar()
  {
    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFacebookUid());

    $profile = $this->toolkit->getFacebookProfile($this->additional_user);
    $facebook_info = $this->generator->facebookInfo($this->additional_user->facebook_uid);
    $facebook_info['pic'] = 'http://fb.com/default_image.gif';
    $profile->setReturnValue('getInfo', $facebook_info);
    $profile->setReturnValue('getRegisteredFriends', array());

    $this->post('login', [
      'token' => $this->additional_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string(64)
    ]);

    $users = User::find();
    if($this->assertEqual(1, count($users)))
    {
      $user = $users->at(0)->exportForApi();
      $this->assertEqual($user->image_36, lmbToolkit::instance()->getStaticUrl("default_image_36.png"));
      $this->assertEqual($user->image_72, lmbToolkit::instance()->getStaticUrl("default_image_72.png"));
      $this->assertEqual($user->image_96, lmbToolkit::instance()->getStaticUrl("default_image_96.png"));
      $this->assertEqual($user->image_192, lmbToolkit::instance()->getStaticUrl("default_image_192.png"));
    }
  }

  function testLogin_TokenLengthGreaterThan128()
  {
    $this->get('is_logged_in', array('token' => str_repeat('A', 150)));
    $this->assertResponse(200);
  }

  function testLogout_ClearSession()
  {
    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('logout', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token = $this->generator->string()
    ]);
    $this->assertResponse(200);

    $res = $this->get('is_logged_in', ['token' => $this->main_user->getFacebookAccessToken()], false);
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }

  function testLogout_RemoveDeviceToken()
  {
    $device_token = $this->generator->string();

    $this->main_user->addToDeviceTokens(new DeviceToken(['token' => $device_token]));
    $this->main_user->save();

    lmbToolkit::instance()->setUser($this->main_user);

    $this->post('logout', [
      'token' => $this->main_user->getFacebookAccessToken(),
      'device_token' => $device_token
    ]);
    $this->assertResponse(200);

    $this->assertEqual(0, count($this->main_user->getDeviceTokens()));
  }
}
