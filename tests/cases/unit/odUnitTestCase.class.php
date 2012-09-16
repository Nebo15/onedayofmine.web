<?php

abstract class odUnitTestCase extends UnitTestCase
{
  /**
   * @var OdObjectMother
   */
  protected $generator;
  /**
   * @var odTestsTools
   */
  protected $toolkit;
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
    $this->toolkit = lmbToolkit::instance();
    $this->toolkit->setConfIncludePath('tests/cases/unit/settings;tests/settings;settings');
    $this->toolkit->resetConfs();
    $this->toolkit->resetFileLocators();

    $this->generator = new odObjectMother();

    parent::setUp();
    $this->toolkit->truncateDb();
    $this->toolkit->resetUser();

    $this->main_user = $this->generator->user();
    $this->additional_user = $this->generator->user();
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
    $rel_path = str_replace(lmbToolkit::instance()->getConf('common')['static_host'], '', $url);
    $abs_path = lmb_env_get('APP_DIR').'/'.$images_conf['save_path'].'/'.$rel_path;
    return $this->assertTrue(file_exists($abs_path), "Invalid image url '{$url}'");
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
}
