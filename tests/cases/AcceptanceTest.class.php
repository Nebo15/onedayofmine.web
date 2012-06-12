<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');


class AcceptanceTest extends WebTestCase
{
  protected $base_api_url = "http://onedayofmine.dev/";
  protected $last_profile_info;
  /**
   * @var User
   */
  protected $main_user;
  /**
   * @var User
   */
  protected $additional_user;

  function setUp()
  {
    parent::setUp();
    User::delete();
    lmbToolkit::instance()->getDefaultDbConnection()->commitTransaction();
    list($this->main_user, $this->additional_user) = FbForTests::getUsers();
  }

  function testIsLoggedIn()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }

  function testLogin()
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

  function testLoginAndSetCookie()
  {
    $this->_loginAndSetCookie($this->main_user);
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testSession_ByGetParam()
  {
    $sessid = $this->_login($this->main_user)->sessid;
    $res = $this->get('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testSession_ByPostParam()
  {
    $sessid = $this->_login($this->main_user)->sessid;
    $res = $this->post('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testLogin_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->_loginAndSetCookie($this->main_user);

    $users = User::find();
    $this->assertEqual(1, count($users));
  }

  function testLogout()
  {
    $this->_logout();
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }

  function testAddDay()
  {
    $this->post('day/create');
    $this->assertResponse(403);

    $this->_loginAndSetCookie($this->main_user);
    $errors = $this->post('day/create');
    $this->assertResponse(200);
    $this->assertTrue('array', gettype($errors));
    $this->assertEqual(2, count($errors));
    $this->assertEqual('title', $errors[0]->fields->Field);
    $this->assertEqual('description', $errors[1]->fields->Field);

    $user = User::findOne();

    $title = $this->_string(4);
    $desc = $this->_string(8);
    $day = $this->post('day/create', array('title' => $title, 'description' => $desc));
    $this->assertEqual($title, $day->title);
    $this->assertEqual($desc, $day->description);
    $this->assertEqual($user->getId(), $day->user_id);
    $this->assertTrue($day->ctime);
    $this->assertTrue($day->utime);
    $this->assertTrue($day->cip);
  }

  function testUserFiendsWithApp()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_login($this->main_user);
    $response = $this->get('user/friends_in_app');
    $this->assertTrue(is_array($response->friends));
    $this->assertEqual(1, count($response->friends));
    $this->assertEqual($response->friends[0]->fb_uid, $this->additional_user->getFbUid());
  }

  function get($url, $params = array())
  {
    return $this->_decodeResponse(parent::get($this->base_api_url . $url, $params));
  }

  function post($url, $params = array())
  {
    return $this->_decodeResponse(parent::post($this->base_api_url . $url, $params));
  }

  protected function _decodeResponse($raw_response)
  {
    $decoded_body = json_decode($raw_response);
    if ($decoded_body === null && strlen($raw_response) > 4) {
      throw new lmbException("Can't parse response", array('url' => $this->getUrl(), 'raw' => $raw_response));
    }

    return $decoded_body;
  }

  protected function _loginAndSetCookie(User $user)
  {
    $sessid = $this->_login($user)->sessid;
    $this->setCookie(lmb_env_get('SESSION_NAME'), $sessid);
  }

  protected function _login(User $user)
  {
    $res = $this->post('auth/login/', array(
      'fb_access_token' => $user->getFbAccessToken()
    ));
    $this->assertResponse(200);

    return $res;
  }

  protected function _logout()
  {
    $this->post('auth/logout/');
    $this->assertResponse(200);
  }

  protected function _splitBodyAndProfile($raw_response)
  {
    $profile_info_begin = strpos($raw_response, "}{\"main\"");

    if (false !== $profile_info_begin) {
      $body = substr($raw_response, 0, $profile_info_begin + 1);
      $profile = substr($raw_response, $profile_info_begin + 1);
      return array($body, $profile);
    } else {
      return array($raw_response, '{}');
    }
  }

  protected function _string($length = 6)
  {
    $conso = array("b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "v", "w", "x", "y", "z");
    $vocal = array("a", "e", "i", "o", "u");
    $password = "";
    srand((double)microtime() * 1000000);
    $max = $length / 2;
    for ($i = 1; $i <= $max; $i++) {
      $password .= $conso[rand(0, 19)];
      $password .= $vocal[rand(0, 4)];
    }
    return $password;
  }
}
