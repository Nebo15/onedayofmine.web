<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');


class AcceptanceTest extends WebTestCase
{
  protected $base_api_url = "http://onedayofmine.dev/";
  protected $last_profile_info;
  /**
   * @var User
   */
  protected $user;

  function setUp()
  {
    User::delete();

    $user = new User();
    $user->setFbUid($fb_user_id = $this->_string(4));
    $user->setFbAccessToken($fb_access_token = $this->_string(4));
    $user->save();
    lmbToolkit::instance()->getDefaultDbConnection()->commitTransaction();
    $this->user = $user;
  }

  function testLoginLogout()
  {
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);

    $this->_login();
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertTrue($res);

    $this->_logout();
    $res = $this->get('auth/is_logged_in');
    $this->assertResponse(200);
    $this->assertFalse($res);
  }

  function testAddDay()
  {
    $this->post('day/create');
    $this->assertResponse(403);

    $this->_login();
    $errors = $this->post('day/create');
    $this->assertResponse(200);
    $this->assertTrue('array', gettype($errors));
    $this->assertEqual(2, count($errors));
    $this->assertEqual('title', $errors[0]->fields->Field);
    $this->assertEqual('description', $errors[1]->fields->Field);

    $title = $this->_string(4);
    $desc = $this->_string(8);
    $day = $this->post('day/create', array('title' => $title, 'description' => $desc));
    $this->assertEqual($title, $day->title);
    $this->assertEqual($desc, $day->description);
    $this->assertEqual($this->user->getId(), $day->user_id);
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

  protected function _login()
  {
    $res = $this->post('auth/login/', array(
        'fb_user_id' => $this->user->getFbUid(),
        'fb_access_token' => $this->user->getFbAccessToken()
    ));
    $this->assertResponse(200);

    $sessid = $res->sessid;

    $this->setCookie(lmb_env_get('SESSION_COOKIE_NAME'), $sessid);
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
