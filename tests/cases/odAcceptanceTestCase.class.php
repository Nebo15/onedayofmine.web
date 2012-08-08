<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');
lmb_require('lib/DocCommentParser/*.class.php');

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
    $this->toolkit->truncateTablesOf('UserSettings', 'User');
    list($this->main_user, $this->additional_user) = $this->toolkit->getTestsUsers($quiet = false);
  }

  function get($url, $params = array(), $doc = true)
  {
    $raw_response = parent::get(lmbToolkit::instance()->getSiteUrl($url), $params);
    $result = $this->_decodeResponse($raw_response);
    if(
      !property_exists($result, 'result') ||
      !property_exists($result, 'errors') ||
      !property_exists($result, 'status') ||
      !property_exists($result, 'code')
    )

    $this->fail('Wrong response structure:'.PHP_EOL.$raw_response);
    if($doc)
      $this->_addRecordsToWriters($url, $params, 'GET', $result->result);
    return $result;
  }

  function post($url, $params = array(), $content_type = false, $doc = true)
  {
    if(is_object($params))
      $params = (array) $params;
    $raw_response = parent::post(lmbToolkit::instance()->getSiteUrl($url), $params);
    $result = $this->_decodeResponse($raw_response);
    if(
      !property_exists($result, 'result') ||
      !property_exists($result, 'errors') ||
      !property_exists($result, 'status') ||
      !property_exists($result, 'code')
    )

    $this->fail('Wrong response structure:'.PHP_EOL.$raw_response);
    if($doc)
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

    $doc_comment = DocCommentParser::tokenize($method_ref->getDocComment());

    if(!$doc_comment->hasGroup('api'))
      return;

//    lmbToolkit::instance()
//      ->getPostmanWriter()
//      ->addRequest($call_name, $url_path, $method, $params);
//
//    lmbToolkit::instance()
//      ->getApiToMarkdownWriter()
//      ->addRequest($call_name, $method, $url_path, $params, $response, $doc_comment);

  }

  protected function _loginAndSetCookie(User $user)
  {
    $this->_login($user)->result;
    $this->setCookie('token', $user->getFbAccessToken());
  }

  protected function _login(User $user)
  {
    $res = $this->post('auth/login/', array('token' => $user->getFbAccessToken()));
    $this->assertResponse(200);
    $this->assertProperty($res->result, 'user');
    return $res;
  }

  protected function _decodeResponse($raw_response)
  {
    $decoded_body = json_decode($raw_response);
    if ($decoded_body === null) {
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

  function assertValidDayJson(Day $valid_day, stdClass $day_from_response)
  {
    $this->assertEqual($valid_day->getId(), $day_from_response->id);
    if($this->assertProperty($valid_day, 'user'))
    {
      $this->assertEqual($valid_day->user->id, $day_from_response->user->id);
      $this->assertEqual($valid_day->user->name, $day_from_response->user->name);
      $this->assertValidImageUrl($day_from_response->user->image_36);
      $this->assertValidImageUrl($day_from_response->user->image_72);
      $this->assertEqual($valid_day->user->sex, $day_from_response->user->sex);
      $this->assertEqual($valid_day->user->birthday, $day_from_response->user->birthday);
      $this->assertEqual($valid_day->user->occupation, $day_from_response->user->occupation);
      $this->assertEqual($valid_day->user->location, $day_from_response->user->location);
      $this->assertEqual($valid_day->user->getFollowers()->count(), $day_from_response->user->followers_count);
      $this->assertEqual($valid_day->user->getFollowing()->count(), $day_from_response->user->following_count);
      $this->assertEqual($valid_day->user->getDays()->count(), $day_from_response->user->days_count);
    }
    $this->assertValidImageUrl($day_from_response->image_266);
    $this->assertValidImageUrl($day_from_response->image_532);
    $this->assertEqual($valid_day->title, $day_from_response->title);
    $this->assertEqual($valid_day->occupation, $day_from_response->occupation);
    $this->assertEqual($valid_day->location, $day_from_response->location);
    $this->assertEqual($valid_day->type, $day_from_response->type);
    $this->assertEqual($valid_day->likes_count, $day_from_response->likes_count);
    $this->assertEqual($valid_day->is_ended, $day_from_response->is_ended);
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

  protected function assertValidImageUrl($url)
  {
    $content = @file_get_contents($url);
    return $this->assertTrue(
      strlen($content),
      "Invalid image url '{$url}'"
    );
  }
}
