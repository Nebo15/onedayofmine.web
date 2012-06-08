<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');


class AcceptanceTest extends WebTestCase
{
  protected $base_api_url = "http://onedayofmine.dev/";
  protected $last_profile_info;
  protected $access_token = 'AAAFnVo0zuqkBAFf2L4BA1RGA68JGnmMcfBPZCwSAgo1ZBMNFNlcxR6mGLCW2OMOD29en9KjZB9hYqRFZBSgeLH2jWJy9kFi0aoZAIZBQS1Faob83JdoXQW';

  /**
   * @var User
   */
  protected $user;

  function setUp()
  {
    User::delete();
    lmbToolkit::instance()->getDefaultDbConnection()->commitTransaction();
  }

  function testIsLoggedIn()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }

  function testLogin()
  {
    $res = $this->_login();
    $this->assertTrue($res->sessid);
    $this->assertTrue(property_exists($res->user, 'uid'));
    $this->assertTrue(property_exists($res->user, 'name'));
    $this->assertTrue(property_exists($res->user, 'pic_small'));
    $this->assertTrue(property_exists($res->user, 'pic_square'));
    $this->assertTrue(property_exists($res->user, 'pic_big'));
    $this->assertTrue(property_exists($res->user, 'profile_url'));
  }

  function testLoginAndSetCookie()
  {
    $this->_loginAndSetCookie();
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testSession_ByGetParam()
  {
    $sessid = $this->_login()->sessid;
    $res = $this->get('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testSession_ByPostParam()
  {
    $sessid = $this->_login()->sessid;
    $res = $this->post('auth/is_logged_in', array(lmb_env_get('SESSION_NAME') => $sessid));
    $this->assertResponse(200);
    $this->assertTrue($res);
  }

  function testLogin_firstCallCreateNewUser()
  {
    $users = User::find();
    $this->assertEqual(0, count($users));

    $this->_loginAndSetCookie();

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

    $this->_loginAndSetCookie();
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

  protected function _loginAndSetCookie()
  {
    $sessid = $this->_login()->sessid;
    $this->setCookie(lmb_env_get('SESSION_NAME'), $sessid);
  }

  protected function _login()
  {
    $res = $this->post('auth/login/', array(
      'fb_access_token' => $this->access_token
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
