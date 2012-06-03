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
    $user->setFbUid($fb_user_id = $this->_createReadableRandomString(4));
    $user->setFbAccessToken($fb_access_token = $this->_createReadableRandomString(4));
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
    $res = $this->get('day/create');
    $this->assertResponse(403);

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
    list($body, $profile_info) = $this->_splitBodyAndProfile($raw_response);

    $this->last_profile_info = $profile_info;

    $decoded_body = json_decode($body);
    if ($decoded_body === null && strlen($body) > 4) {
      throw new lmbException("Can't parse response", array('url' => $this->getUrl(), 'raw' => $body));
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

  protected function _createReadableRandomString($length = 6)
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
