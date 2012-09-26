<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');
lmb_require('lib/DocCommentParser/*.class.php');
lmb_require('facebook-proxy/src/Client.php');
lmb_require('tests/cases/odEntityAssertions.trait.php');

abstract class odAcceptanceTestCase extends WebTestCase
{
  use odEntityAssertions;

  /**
   * @var OdObjectMother
   */
  protected $generator;
  /**
   * @var lmbSimpleDb
   */
  protected $db;
  /**
   * @var [type]
   */
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
    $this->toolkit->setConfIncludePath('tests/cases/integration/settings;tests/settings;settings');
    $this->toolkit->resetConfs();
    $this->toolkit->resetFileLocators();
    parent::setUp();
    $this->toolkit->truncateDb();
    list($this->main_user, $this->additional_user) = $this->toolkit->getTestsUsers($quiet = false);
  }

  function get($url, $params = array())
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
    return $result;
  }

  function post($url, $params = array(), $content_type = false)
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

    lmbToolkit::instance()
      ->getPostmanWriter()
      ->addRequest($call_name, $url_path, $method, $params);

    lmbToolkit::instance()
      ->getApiToMarkdownWriter()
      ->addRequest($call_name, $method, $url_path, $params, $response, $doc_comment);

  }

  protected function _loginAndSetCookie(User $user, $disable_sharing = true)
  {
    $res = $this->_login($user, $disable_sharing);
    $this->setCookie('token', $user->getFacebookAccessToken());
    return $res;
  }

  protected function _login(User $user, $disable_sharing = true)
  {
    $params = array(
      'token' => $user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    );
    if($disable_sharing)
      $params['disable_sharing'] = 1;
    $res = $this->post('auth/login/', $params);
    $this->assertResponse(200);
    $this->assertProperty($res->result, 'name');
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

  protected function assertImageUrl($url, $message = "Invalid image url '%s'")
  {
    $this->assertTrue($url, sprintf('Empty image url', $url));

    $handle = curl_init($url);
    $this->assertTrue($handle, "Can't init cURL");

    curl_setopt($handle, CURLOPT_HEADER, false);
    curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
    curl_setopt($handle, CURLOPT_NOBODY, true);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
    $connectable = curl_exec($handle);
    curl_close($handle);

    return $this->assertTrue(
      $connectable,
      sprintf($message, $url)
    );
  }
}
