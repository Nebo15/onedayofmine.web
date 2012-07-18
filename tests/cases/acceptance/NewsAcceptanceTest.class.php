<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class NewsAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News');
  }

  // TODO
  function testGetNewNews() {

  }

  // TODO
  function testGetArchiveNews() {

  }
}
