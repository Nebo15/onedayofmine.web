<?php
lmb_require('limb/tests_runner/lib/simpletest/web_tester.php');
lmb_require('lib/DocCommentParser/*.class.php');
lmb_require('facebook-proxy/src/Client.php');
lmb_require('tests/cases/odEntityAssertions.trait.php');

abstract class odIntegrationTestCase extends WebTestCase
{
  use odEntityAssertions;

  /**
   * @var OdObjectMother
   */
  protected $generator;
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

  protected function assertResponseClass(stdClass $response, $message = "Wrong response structure")
  {
    $this->assertPropertys($response, [
      'result',
      'errors',
      'status',
      'code',
    ], $message);
  }

  function assertResponse($code, $message = 'Expecting response in [%s] got [%s] in response: %s')
  {
    $response_code = $this->getBrowser()->getResponseCode();

    return $this->assertEqual(
      $code,
      $response_code,
      sprintf($message,
        $code, $response_code, $this->getBrowser()->getContent()
      )
    );
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

  protected function assert404Url($url)
  {
    $r = new HttpRequest($url, HttpRequest::METH_GET);
    try {
      $r->send();
      $this->assertEqual(404, $r->getResponseCode());
    } catch (HttpException $ex) {
      $this->fail($ex->getMessage());
    }
  }

  function get($url, $params = array())
  {
    if(is_object($params))
      $params = (array) $params;

    $raw_response = parent::get(lmbToolkit::instance()->getSiteUrl($url), $params);
    $response = $this->_decodeResponse($raw_response);

    $this->assertResponseClass($response, "Wrong response structure: {$raw_response}.");

    return $response;
  }

  function post($url, $params = array(), $content_type = false)
  {
    if(is_object($params))
      $params = (array) $params;

    $raw_response = parent::post(lmbToolkit::instance()->getSiteUrl($url), $params);
    $response = $this->_decodeResponse($raw_response);

    $this->assertResponseClass($response, "Wrong response structure: {$raw_response}.");

    return $response;
  }

  protected function _login(User $user)
  {
    $response = $this->post('auth/login/', [
      'token'        => $user->getFacebookAccessToken(),
      'device_token' => $this->generator->string(64)
    ]);

    if($this->assertResponse(200))
      $this->assertProperty($response->result, 'name');

    return $response;
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
}
