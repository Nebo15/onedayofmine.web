<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class NewsObserverAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News');
  }
}
