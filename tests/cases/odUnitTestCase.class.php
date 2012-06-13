<?php

abstract class odUnitTestCase extends UnitTestCase
{
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

  function setUp()
  {
    $this->generator = new odObjectMother();
    parent::setUp();
    odTestsTools::truncateTablesOf('User');
    list($this->main_user, $this->additional_user) = odTestsTools::getUsers();
  }
}
