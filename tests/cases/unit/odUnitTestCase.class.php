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

    parent::setUp();

    $this->toolkit->setConfIncludePath('tests/cases/unit/settings;tests/settings;settings');
    $this->toolkit->resetConfs();
    $this->toolkit->resetFileLocators();

    $this->toolkit->truncateTablesOf('UserSettings', 'User');

    $this->toolkit->resetUser();

    $this->main_user = $this->generator->user();
    $this->additional_user = $this->generator->user();
  }
}
