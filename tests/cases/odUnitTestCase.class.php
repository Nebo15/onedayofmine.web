<?php
lmb_require('tests/cases/odObjectMother.class.php');

abstract class odUnitTestCase extends UnitTestCase
{
  /**
   * @var OdObjectMother
   */
  protected $generator;

  function setUp()
  {
    parent::setUp();
    $this->generator = new odObjectMother();
  }
}
