<?php
lmb_require('tests/cases/odEntityAssertions.trait.php');
lmb_require('limb/dbal/src/drivers/lmbAuditDbConnection.class.php');

abstract class odUnitTestCase extends UnitTestCase
{
  use odEntityAssertions;

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

  /**
   * @var lmbDbConnection
   */
  protected $db_conn;

  function setUp()
  {
    $this->toolkit = lmbToolkit::instance();
    $this->toolkit->setConfIncludePath('tests/cases/unit/settings;tests/settings;settings');
    $this->toolkit->resetConfs();
    $this->toolkit->resetFileLocators();

    $this->db_conn = $this->toolkit->getDefaultDbConnection();
    $this->db = new lmbSimpleDb($this->db_conn);

    $this->generator = new odObjectMother();

    parent::setUp();
    $this->toolkit->truncateDb();
    $this->toolkit->resetUser();

    $this->main_user = $this->generator->user('main_user');
    $this->additional_user = $this->generator->user('additional_user');
  }
}
