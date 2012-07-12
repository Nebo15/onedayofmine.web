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

  /**
   * @var odTestsTools
   */
  protected $toolkit;

  function setUp()
  {
    $this->generator = new odObjectMother();
    $this->toolkit = lmbToolkit::instance();
    parent::setUp();
    $this->toolkit->truncateTablesOf('User');
    list($this->main_user, $this->additional_user) = $this->toolkit->getTestsUsers($quiet = false);
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
    $this->_addRecordsToWriters($url, $params, 'POST', $result->result);
    return $result;
  }

  function post($url, $params = array(), $content_type = false)
  {
    if(is_object($params))
      $params = (array) $params;
    $raw_response = parent::post(lmb_env_get('HOST_NAME') . $url, $params);
    $result = $this->_decodeResponse($raw_response);
    if(
      !property_exists($result, 'result') ||
      !property_exists($result, 'errors') ||
      !property_exists($result, 'status') ||
      !property_exists($result, 'code')
    )
      $this->fail('Wrong response structure:'.PHP_EOL.$raw_response);
    $this->_addRecordsToWriters($url, $params, 'POST', $result->result);
    return $result;
  }

  protected function _addRecordsToWriters($url_path, $params, $method, $response)
  {
    $trace = debug_backtrace();
    $class_name = get_called_class();
    $method_name = $trace[2]['function'];
    $class_ref = new ReflectionClass($class_name);
    $method_ref = $class_ref->getMethod($method_name);
    $call_name = str_replace('AcceptanceTest', '', $class_name).' - '.str_replace('test', '', $method_name);
    $is_example = (bool) (false !== strpos($method_ref->getDocComment(), '@show'));

    preg_match_all('#@([a-zA-Z0-9\-]+)([^\n\r]*)#i', $method_ref->getDocComment(), $out);

    $docBlockEntities = array();
    foreach ($out[1] as $key => $name) {
      if($name == 'option' || $name == 'param' || $name == 'result-param') {
        $docBlockEntities[$name][] = trim($out[2][$key]);
      } else {
        $docBlockEntities[$name] = trim($out[2][$key]);
      }
    }

    if(!array_key_exists('public', $docBlockEntities)) {
      return;
    }

    lmbToolkit::instance()
      ->getPostmanWriter()
      ->addRequest($call_name, $url_path, $method, $params);

    // Returns associative array based on dockblock description, assumes there are always type and name params.
    $paramParser = function($description, $required) {
      $tokens = explode(' ', $description);

      if(count($tokens) < 2)
        throw new lmbException("You need to descripte both type and name in dock block for method {$call_name}.");

      return array(
        'required'    => $required,
        'type'        => array_shift($tokens),
        'name'        => array_shift($tokens),
        'description' => implode(' ', $tokens)
      );
    };

    $description = array_key_exists('description', $docBlockEntities) ? $docBlockEntities['description'] : null;

    $requestParams = array();
    if(array_key_exists('option', $docBlockEntities)) {
      foreach ($docBlockEntities['option'] as $option) {
        $requestParams[] = $paramParser($option, false);
      }
    }
    if(array_key_exists('param', $docBlockEntities)) {
      foreach ($docBlockEntities['param'] as $param) {
        $requestParams[] = $paramParser($param, true);
      }
    }

    $responseParams = array();
    if(array_key_exists('result-param', $docBlockEntities)) {
      foreach ($docBlockEntities['result-param'] as $param) {
        $responseParams[] = $paramParser($param, true);
      }
    }

    lmbToolkit::instance()
      ->getApiToMarkdownWriter()
      ->addRequest($call_name, $url_path, $method, $description, $params, $requestParams, $response, $responseParams);

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
      throw new lmbException("Can't parse response", array(
      		'url' => $this->getUrl(),
      		'raw' => $raw_response
      ));
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

  function assertResponse($responses, $message = '%s')
  {
  	$responses = (is_array($responses) ? $responses : array($responses));
    $code = $this->browser->getResponseCode();
    $message = sprintf('%s', "Expecting response in [" .
    	implode(", ", $responses) . "] got [$code] in response:".($this->browser->getContent()));
    return $this->assertTrue(in_array($code, $responses), $message);
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
