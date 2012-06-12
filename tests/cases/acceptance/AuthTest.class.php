<?php
lmb_require('tests/cases/AcceptanceTestCase.class.php');


class AuthTest extends AcceptanceTestCase
{
  function testAuth_IsLoggedIn()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }

  function testAuth_Login()
  {
    $res = $this->_login($this->main_user);
    $this->assertTrue($res->sessid);
    $this->assertTrue($res->user);
    $this->assertTrue(is_object($res->user));
    $this->assertTrue($res->user->id);
    $this->assertTrue($res->user->cip);
    $this->assertTrue($res->user->ctime);
    $this->assertTrue($res->user->utime);
    $this->assertTrue($res->user->fb_uid);
    $this->assertTrue($res->user->fb_profile_utime);
    $this->assertTrue($res->user->fb_name);
    $this->assertTrue($res->user->fb_profile_url);
    $this->assertTrue($res->user->sex);
    $this->assertTrue($res->user->timezone);
    $this->assertTrue($res->user->pic_small);
    $this->assertTrue($res->user->pic_square);
    $this->assertTrue($res->user->pic_big);
  }

  function testAuth_LoginAndSetCookie()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testAuth_Session_ByGetParam()
  {
    $sessid = $this->_login($this->main_user)->sessid;
    $res = $this->get('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testAuth_Session_ByPostParam()
  {
    $sessid = $this->_login($this->main_user)->sessid;
    $res = $this->post('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testAuth_Login_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->_loginAndSetCookie($this->main_user);

    $users = User::find();
    $this->assertEqual(1, count($users));
  }

  function testAuth_Logout()
  {
    $this->_logout();
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }
}
