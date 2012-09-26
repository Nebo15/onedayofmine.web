 <?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class NewsTest extends odUnitTestCase
{

  function testCreatedCorrectly() {
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient);
    $news->save();

    $this->assertTrue(count(News::find()) == 1);
    $this->assertEqual(News::findOne()->text, $news->text);
    $this->assertEqual(News::findOne()->text, $creator->name . ' likes ' . $recipient->name);
  }
}
