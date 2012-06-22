<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');

abstract class odAcceptanceTestCase extends WebTestCase
{
  /**
   * @var OdObjectMother
   */
  protected $generator;

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
    $this->generator = new odObjectMother();
    parent::setUp();
    odTestsTools::truncateTablesOf('User');
    list($this->main_user, $this->additional_user) = odTestsTools::getUsers();
  }

  function get($url, $params = array())
  {
    $raw_response = parent::get(lmb_env_get('HOST_NAME') . $url, $params);
    $result = $this->_decodeResponse($raw_response);
    if(
      !property_exists($result, 'result') ||
      !property_exists($result, 'errors') ||
      !property_exists($result, 'status') ||
      !property_exists($result, 'code')
    )
      $this->fail('Wrong response structure:'.PHP_EOL.$raw_response);
    $this->_addRecordToPostmanWriter($url, $params, 'POST');
    return $result;
  }

  function post($url, $params = array())
  {
    $raw_response = parent::post(lmb_env_get('HOST_NAME') . $url, $params);
    $result = $this->_decodeResponse($raw_response);
    if(
      !property_exists($result, 'result') ||
      !property_exists($result, 'errors') ||
      !property_exists($result, 'status') ||
      !property_exists($result, 'code')
    )
      $this->fail('Wrong response structure:'.PHP_EOL.$raw_response);
    $this->_addRecordToPostmanWriter($url, $params, 'POST');
    return $result;
  }

  protected function _addRecordToPostmanWriter($url_path, $params, $method)
  {
    $trace = debug_backtrace();
    $class_name = get_called_class();
    $method_name = $trace[2]['function'];
    $class_ref = new ReflectionClass($class_name);
    $method_ref = $class_ref->getMethod($method_name);
    $call_name = str_replace('AcceptanceTest', '', $class_name).' - '.str_replace('test', '', $method_name);
    $is_example = (bool) (false !== strpos($method_ref->getDocComment(), '@example'));
    if($is_example)
      lmbToolkit::instance()
        ->getPostmanWriter()
        ->addRequest($call_name, $url_path, $method, $params);
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

  protected function assertProperty($obj, $property, $message = "Property '%s' not found")
  {
    if(!is_object($obj))
      return $this->fail("Expected a object but '".gettype($obj)."' given");
    return $this->assertTrue(
      property_exists($obj, $property),
      sprintf($message, $property)
    );
  }
}
