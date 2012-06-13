<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class SearchAcceptanceTest extends odAcceptanceTestCase
{
  function testSuggest()
  {
    $res = $this->get('search/suggest');
    $this->assertResponse(200);
  }

  function testSearch()
  {
    $res = $this->get('search/text');
    $this->assertResponse(200);
  }
}
