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
    $this->generator = new odObjectMother();
    $this->toolkit = lmbToolkit::instance();
    $this->toolkit->resetConf('amazon');
    $this->toolkit->resetConf('images');
    $this->toolkit->resetConf('common');
    $this->toolkit->setConfIncludePath('tests/cases/unit/settings;tests/settings;settings');
    parent::setUp();
    $this->toolkit->truncateTablesOf('User');
    list($this->main_user, $this->additional_user) = $this->toolkit->getTestsUsers($quiet = false);
  }
}
