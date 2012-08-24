<?php
//lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');
lmb_require('lib/DocCommentParser/*.class.php');
lmb_require('lib/limb/net/src/lmbHttpRequest.class.php');
lmb_require('src/controller/AuthController.class.php');

abstract class odControllerTestCase extends UnitTestCase
{
  /**
   * @var OdObjectMother
   */
  protected $generator;
  /**
   * @var string
   */
  protected $controller_class;
  /**
   * @var stdClass
   */
  protected $last_response;
  protected $last_response_raw;
  protected $cookies = array();

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
    if(!$this->controller_class)
      throw new lmbException('You must specify controller class');

    $this->generator = new odObjectMother();
    $this->toolkit = lmbToolkit::instance();
    parent::setUp();
    $this->toolkit->truncateTablesOf('UserSettings', 'User');
    list($this->main_user, $this->additional_user) = $this->toolkit->getTestsUsers($quiet = false);
    $this->toolkit->resetUser();
  }

  protected function _loginAndSetCookie(User $user)
  {
    $this->cookies['token'] = $user->getFbAccessToken();
    return $this->_login($user);
  }

  protected function _login(User $user)
  {
    $request = new lmbHttpRequest(null, null, array('token' => $user->getFbAccessToken()));
    $request->setRequestMethod('POST');
    $res = $this->request('AuthController', 'login', $request);
    $this->assertResponse(200);
    $this->assertProperty($res->result, 'name');
    return $res;
  }

  function get($action, $params = array(), $id = null)
  {
    $request = new lmbHttpRequest(null, (array) $params);
    $request->setRequestMethod('GET');
    if($id)
      $request->set('id', $id);
    $result = $this->request($this->controller_class, $action, $request);
    return $result;
  }

  function post($action, $post_params = array(), $id = null)
  {
    $request = new lmbHttpRequest(null, null, (array) $post_params);
    $request->setRequestMethod('POST');
    if($id)
      $request->set('id', $id);
    $result = $this->request($this->controller_class, $action, $request);
    return $result;
  }

  function request($controller_class, $action, lmbHttpRequest $request)
  {
    $request->setCookies($this->cookies);
    $controller = new $controller_class;
    $controller->setRequest($request);
    $controller->setCurrentAction($action);
    $this->last_response_raw = $controller->performAction();
    $this->last_response = $this->_decodeResponse($this->last_response_raw);
    if(
      !property_exists($this->last_response, 'result') ||
      !property_exists($this->last_response, 'errors') ||
      !property_exists($this->last_response, 'status') ||
      !property_exists($this->last_response, 'code')
    )
      $this->fail('Wrong response structure:'.PHP_EOL.$this->last_response_raw);
    return clone $this->last_response;
  }

  protected function _decodeResponse($raw_response)
  {
    $decoded_body = json_decode($raw_response);
    if ($decoded_body === null) {
      throw new lmbException("Can't parse response", array(
          'raw' => $raw_response
      ));
    }
    return $decoded_body;
  }

  function assertValidUserJson(User $valid_user, stdClass $user_from_response)
  {
    $this->assertEqual($valid_user->id,
      $user_from_response->id);
    $this->assertEqual($valid_user->name, $user_from_response->name);
    if($user_from_response->image_36)
      $this->assertValidImageUrl($user_from_response->image_36);
    if($user_from_response->image_72)
      $this->assertValidImageUrl($user_from_response->image_72);
    if($user_from_response->image_96)
      $this->assertValidImageUrl($user_from_response->image_96);
    if($user_from_response->image_192)
      $this->assertValidImageUrl($user_from_response->image_192);
    $this->assertEqual($valid_user->sex, $user_from_response->sex);
    $this->assertEqual($valid_user->birthday, $user_from_response->birthday);
    $this->assertEqual($valid_user->occupation, $user_from_response->occupation);
    $this->assertEqual($valid_user->location, $user_from_response->location);
    $this->assertEqual($valid_user->getFollowers()->count(), $user_from_response->followers_count);
    $this->assertEqual($valid_user->getFollowing()->count(), $user_from_response->following_count);
    $this->assertEqual($valid_user->getDays()->count(), $user_from_response->days_count);
  }

  function assertValidDayJson(Day $valid_day, stdClass $day_from_response)
  {
    $this->assertEqual($valid_day->getId(), $day_from_response->id);
    if($this->assertProperty($day_from_response, 'user'))
      $this->assertValidUserJson($valid_day->getUser(), $day_from_response->user);
    $this->assertTrue($day_from_response->image_266);
    $this->assertTrue($day_from_response->image_532);
    $this->assertValidImageUrl($day_from_response->image_266);
    $this->assertValidImageUrl($day_from_response->image_532);
    $this->assertEqual($valid_day->title, $day_from_response->title);
    $this->assertEqual($valid_day->occupation, $day_from_response->occupation);
    $this->assertEqual($valid_day->location, $day_from_response->location);
    $this->assertEqual($valid_day->type, $day_from_response->type);
    $this->assertEqual($valid_day->likes_count, $day_from_response->likes_count);
  }

  function assertResponse($responses)
  {
    $responses = (is_array($responses) ? $responses : array($responses));
    $code = $this->last_response->code;
    $message = sprintf('%s', "Expecting response in [" .
      implode(", ", $responses) . "] got [$code] in response:".($this->last_response_raw));
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
    $images_conf = lmbToolkit::instance()->getConf('images');
    $rel_path = str_replace($images_conf['host'], '', $url);
    $abs_path = lmb_env_get('APP_DIR').$images_conf['save_path'].'/'.$rel_path;
    return $this->assertTrue(
      file_exists($abs_path),
      "Invalid image url '{$url}'"
    );
  }
}
