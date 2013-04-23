 <?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
 lmb_require('src/model/User.class.php');
 lmb_require('src/model/News.class.php');

class NewsTest extends odUnitTestCase
{
  function testCreatedCorrectly()
  {
    $creator = $this->generator->user();
    $creator->save();

    $recipient = $this->generator->user();
    $recipient->save();

    $news = $this->generator->news($creator, $recipient, odNewsService::MSG_USER_FOLLOW);
    $news->save();

    $this->assertEqual(1, count(News::find()));
    $this->assertEqual(News::findFirst()->text, $news->text);
    $this->assertEqual(strip_tags(News::findFirst()->text), $creator->name . ' started to following ' . $recipient->name);
  }
}
