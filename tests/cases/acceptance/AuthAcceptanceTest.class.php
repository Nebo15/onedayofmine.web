<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class AuthAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
   */
  function testIsLoggedIn()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }

  /**
   *@example
   */
  function testLogin()
  {
    $res = $res = $this->post('auth/login/', array(
      'fb_access_token' => $this->main_user->getFbAccessToken()
    ))->result;
    $this->assertTrue($res->sessid);
    $this->assertTrue($res->user);
    $this->assertTrue(is_object($res->user));
    $this->assertTrue($res->user->id);
    $this->assertTrue($res->user->ctime);
    $this->assertTrue($res->user->utime);
    $this->assertTrue($res->user->fb_uid);
    $this->assertTrue($res->user->fb_profile_utime);
    $this->assertTrue($res->user->fb_name);
    $this->assertTrue($res->user->fb_profile_url);
    $this->assertTrue($res->user->fb_timezone);
    $this->assertTrue($res->user->sex);
    $this->assertTrue($res->user->pic_small);
    $this->assertTrue($res->user->pic_square);
    $this->assertTrue($res->user->pic_big);
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
    $sessid = $this->_login($this->main_user)->result->sessid;
    $res = $this->get('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res->result);
  }

  function testLogin_Session_ByPostParam()
  {
    $sessid = $this->_login($this->main_user)->result->sessid;
    $res = $this->post('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
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
  }

  function testLogin_WrongAccessToken()
  {
    $errors = $res = $this->post('auth/login/', array(
      'fb_access_token' => 'Wrong access token'
    ))->errors;
    $this->assertResponse(403);
    $this->assertEqual(1, count($errors));
    $this->assertEqual('Invalid OAuth access token.', $errors[0]);
  }

  function testLogout()
  {
    $this->post('auth/logout/');
    $this->assertResponse(200);

    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res->result);
  }
}
