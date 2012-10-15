 <?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
 lmb_require('src/model/User.class.php');
 lmb_require('src/model/News.class.php');

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
    $this->assertEqual(News::findFirst()->text, $news->text);
    $this->assertEqual(News::findFirst()->text, $creator->name . ' likes ' . $recipient->name);
  }
}
