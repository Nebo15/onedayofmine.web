<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class NewsTest extends odUnitTestCase
{
  function setUp() {
    parent::setUp();
    odTestsTools::truncateTablesOf('News');
  }

  function testCreatedCorrectly() {
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    $this->assertTrue(count(News::find()) == 1);
    $this->assertEqual(News::findOne()->text, $news->text);
    $this->assertEqual(News::findOne()->text, $creator->first_name . ' likes ' . $recipient->first_name);
  }
}
