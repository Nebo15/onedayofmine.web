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

    $news = $this->generator->news($creator, $recipient, News::MSG_USER_FOLLOW);
    $news->save();

    $this->assertEqual(1, count(News::find()));
    $this->assertEqual(News::findFirst()->text, $news->text);
    $this->assertEqual(strip_tags(News::findFirst()->text), $creator->name . ' started to following ' . $recipient->name);
  }

	function testFindUnreadFor()
	{
		$recipient = $this->generator->user();
		$recipient->save();

		$this->assertEqual(0, count(News::findUnreadFor($recipient)));

		$this->generator->news($creator = null, $recipient, News::MSG_USER_FOLLOW);

		$this->assertEqual(1, count(News::findUnreadFor($recipient)));

		$recipient->markAllNewsAsRead();

		$this->assertEqual(0, count(News::findUnreadFor($recipient)));
	}
}
