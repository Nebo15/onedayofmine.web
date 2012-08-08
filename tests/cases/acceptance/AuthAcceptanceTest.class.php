<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


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
    $res = $res = $this->post('auth/login/', array(
      'token' => $this->main_user->getFbAccessToken()
    ))->result;
    if($this->assertResponse(200))
    {
      $this->assertTrue($res->user);
      $this->assertTrue(is_object($res->user));
      $this->assertTrue($res->user->id);
      $this->assertTrue($res->user->name);
      $this->assertTrue($res->user->email);
      $this->assertTrue($res->user->sex);
      $this->assertTrue($res->user->image_36);
      $this->assertTrue($res->user->image_72);
      $this->assertTrue($res->user->birthday);
    }
  }

  function testLogin_followInformation()
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
      $this->assertEqual($res->user->following_count, $following->count());
      $this->assertEqual($res->user->followers_count, $followers->count());
      $this->assertEqual($res->user->following[0]->id, $this->additional_user->getId());
      $this->assertEqual($res->user->followers[0]->id, $this->additional_user->getId());
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

  // TODO cache dont work on invalid tokens
  function testLogin_WrongAccessToken()
  {
    $errors = $res = $this->post('auth/login/', array('token' => $this->generator->string(11)))->errors;
    $this->assertResponse(403);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Invalid OAuth access token.', $errors[0]);
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
