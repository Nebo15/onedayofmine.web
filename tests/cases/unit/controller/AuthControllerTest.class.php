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
    $res = $this->get('is_logged_in', ['token' => $this->main_user->getFbAccessToken()]);
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
      ->setReturnValue('getUid', $this->additional_user->getFbUid());

    $res = $this->post('login', array(
      'token' => $this->additional_user->getFbAccessToken()
    ))->result;

    if($this->assertResponse(200))
    {
      $loaded_user = User::findById($res->id);
      $this->assertValidUserJson($loaded_user, $res);
      $this->assertEqual($loaded_user->getFavouriteDays()->count(), $res->favourites_count);
      $this->assertEqual($loaded_user->getEmail(), $res->email);
    }
  }

  function testLogin_AndSetCookie()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFbUid());

    $this->post('login', [
      'token' => $this->main_user->getFbAccessToken()
    ]);
    $res = $this->get('is_logged_in', [
      'token' => $this->main_user->getFbAccessToken()
    ]);
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByGetParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFbUid());

    $this->post('login', [
      'token' => $this->main_user->getFbAccessToken()
    ]);
    $res = $this->get('is_logged_in', array('token' => $this->main_user->getFbAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByPostParam()
  {
    $this->main_user->save();
    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFbUid());

    $this->post('login', [
      'token' => $this->main_user->getFbAccessToken()
    ]);
    $res = $this->get('is_logged_in', array('token' => $this->main_user->getFbAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->toolkit->getFacebook($this->main_user)
      ->setReturnValue('getUid', $this->main_user->getFbUid());

    $profile = $this->toolkit->getFacebookProfile($this->main_user);
    $profile->setReturnValue('getInfo', $info = $this->generator->facebookInfo($this->main_user->fb_uid));
    $profile->setReturnValue('getRegisteredFriends', array());

    $this->post('login', ['token' => $this->main_user->getFbAccessToken()]);

    $users = User::find();
    $this->assertEqual(1, count($users));

    $this->post('login', ['token' => $this->main_user->getFbAccessToken()]);

    $users = User::find();
    $this->assertEqual(1, count($users));
    $user = $users->at(0)->exportForApi();
    $this->assertTrue($user->image_36);
    $this->assertTrue($user->image_72);
  }

  /**
   * @api
   */
  function testLogin_WrongAccessToken()
  {
    $this->cookies = array();
    $result = $this->post('login', array('token' => 'Wrong_access_token'));
    $errors = $result->errors;
    $this->assertResponse(403);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Invalid OAuth access token.', $errors[0]);
  }


  function testLogin_AccessTokenNotGiven()
  {
    $this->cookies = array();
    $errors = $this->post('login', array())->errors;
    $this->assertResponse(412);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Token not given', $errors[0]);
  }

  function testLogin_firstCallCreateNewUserWithDefaultAvatar()
  {
    $this->toolkit->getFacebook($this->additional_user)
      ->setReturnValue('getUid', $this->additional_user->getFbUid());

    $profile = $this->toolkit->getFacebookProfile($this->additional_user);
    $fb_info = $this->generator->facebookInfo($this->additional_user->fb_uid);
    $fb_info['pic'] = 'http://fb.com/default_image.gif';
    $profile->setReturnValue('getInfo', $fb_info);
    $profile->setReturnValue('getRegisteredFriends', array());

    $this->post('login', ['token' => $this->additional_user->getFbAccessToken()]);

    $users = User::find();
    $this->assertEqual(1, count($users));
    $user = $users->at(0)->exportForApi();
    $this->assertEqual($user->image_36, lmbToolkit::instance()->getStaticUrl("default_image_36.png"));
    $this->assertEqual($user->image_72, lmbToolkit::instance()->getStaticUrl("default_image_72.png"));
    $this->assertEqual($user->image_96, lmbToolkit::instance()->getStaticUrl("default_image_96.png"));
    $this->assertEqual($user->image_192, lmbToolkit::instance()->getStaticUrl("default_image_192.png"));
  }

  function testLogin_TokenLengthGreaterThan128()
  {
    $this->get('is_logged_in', array('token' => str_repeat('A', 150)));
    $this->assertResponse(200);
  }

  /**
   * @deprecated
   */
  function _testLogout() {
    $this->post('logout');
    $this->assertResponse(200);

    $res = $this->get('is_logged_in', array(), false);
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }
}
