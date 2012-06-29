<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class SearchAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
   */
  function testSearch()
  {
    $res = $this->get('search/text');
    $this->assertResponse(200);
  }
}
