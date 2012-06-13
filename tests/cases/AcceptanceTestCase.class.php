<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');


abstract class AcceptanceTestCase extends WebTestCase
{
  /**
   * @var ObjectMother
   */
  protected $generator;

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
    $this->generator = new ObjectMother();
    parent::setUp();
    User::delete();
    lmbToolkit::instance()->getDefaultDbConnection()->commitTransaction();
    list($this->main_user, $this->additional_user) = FbForTests::getUsers();
  }

  function get($url, $params = array())
  {
    $result = $this->_decodeResponse(parent::get($this->base_api_url . $url, $params));
    $this->assertTrue(property_exists($result, 'result'));
    $this->assertTrue(property_exists($result, 'errors'));
    $this->assertTrue(property_exists($result, 'status'));
    $this->assertTrue(property_exists($result, 'code'));
    return $result;
  }

  function post($url, $params = array())
  {
    $result = $this->_decodeResponse(parent::post($this->base_api_url . $url, $params));
    $this->assertTrue(property_exists($result, 'result'));
    $this->assertTrue(property_exists($result, 'errors'));
    $this->assertTrue(property_exists($result, 'status'));
    $this->assertTrue(property_exists($result, 'code'));
    return $result;
  }

  protected function _loginAndSetCookie(User $user)
  {
    $sessid = $this->_login($user)->result->sessid;
    $this->assertTrue($sessid);
    $this->setCookie(lmb_env_get('SESSION_NAME'), $sessid);
  }

  protected function _login(User $user)
  {
    $res = $this->post('auth/login/', array(
      'fb_access_token' => $user->getFbAccessToken()
    ));
    $this->assertProperty($res->result, 'sessid');
    $this->assertProperty($res->result, 'user');
    $this->assertResponse(200);
    return $res;
  }

  protected function _logout()
  {
    $this->post('auth/logout/');
    $this->assertResponse(200);
  }

  protected function _decodeResponse($raw_response)
  {
    $decoded_body = json_decode($raw_response);
    if ($decoded_body === null && strlen($raw_response) > 4) {
      throw new lmbException("Can't parse response", array('url' => $this->getUrl(), 'raw' => $raw_response));
    }

    return $decoded_body;
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

  protected function assertProperty($obj, $property)
  {
    if(!is_object($obj))
      return $this->fail("Expected a object but '".gettype($obj)."' given");
    return $this->assertTrue(
      property_exists($obj, $property),
      sprintf("Property '%s' not found", $property)
    );
  }
}
