<?php
lmb_require('tests/cases/acceptance/odAcceptanceTestCase.class.php');


class AuthAcceptanceTest extends odAcceptanceTestCase
{
  /**
   * @api description Returns user authentication status.
   * @api result bool - TRUE if user is logged id, else - FALSE
   */
  function testIsLoggedIn()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }


  /**
   * @api description User authorization.
   * @api input param string[118] token Facebook access token
   * @api result User user Authorized user information
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

    $res = $res = $this->post('auth/login/', array(
      'token' => $this->main_user->getFbAccessToken()
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
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByGetParam()
  {
    $this->_login($this->main_user)->result;
    $res = $this->get('auth/is_logged_in', array('token' => $this->main_user->getFbAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByPostParam()
  {
    $this->_login($this->main_user)->result;
    $res = $this->post('auth/is_logged_in', array('token' => $this->main_user->getFbAccessToken()));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->_loginAndSetCookie($this->main_user);

    $users = User::find();
    $this->assertEqual(1, count($users));

    $this->_loginAndSetCookie($this->main_user);

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
    $errors = $res = $this->post('auth/login/', array('token' => $this->generator->string(11)))->errors;
    $this->assertResponse(403);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Invalid OAuth access token.', $errors[0]);
  }

  function testLogin_AccessTokenNotGiven()
  {
    $errors = $res = $this->post('auth/login/', array())->errors;
    $this->assertResponse(412);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Token not given', $errors[0]);
  }

  function testLogin_TokenLengthGreaterThan128()
  {
    $this->get('auth/is_logged_in', array('token' => str_repeat('A', 150)));
    $this->assertResponse(200);
  }

  /**
   * @deprecated
   */
  function testLogout() {
    $this->post('auth/logout/');
    $this->assertResponse(200);

    $res = $this->get('auth/is_logged_in', array(), false);
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }
}
