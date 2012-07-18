<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class NewsAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News');
  }

  function estCreate()
  {
    //$this->main_user, $this->additional_user

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    var_dump($recipient->getNews());

  }

  function estGet() {

  }
}
