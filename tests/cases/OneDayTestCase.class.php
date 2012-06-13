<?php
lmb_require('tests/cases/ObjectMother.class.php');

abstract class OneDayTestCase extends UnitTestCase
{
  /**
   * @var ObjectMother
   */
  protected $generator;

  function setUp()
  {
    parent::setUp();
    $this->generator = new ObjectMother();
  }
}
