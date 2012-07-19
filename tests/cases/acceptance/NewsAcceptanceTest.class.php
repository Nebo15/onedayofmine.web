<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class NewsAcceptanceTest extends odAcceptanceTestCase
{
  function setUp()
  {
    parent::setUp();
    odTestsTools::truncateTablesOf('News');
  }

  /**
   * @api description Get list of news that was created after specified news.
   * @api input param int last ID of latest present in application news
   * @api result News[] - List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)
   */
  function testGetNewNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    // News are empty
    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertFalse(count($response->result));

    // Adding new news
    $news = $this->generator->news();
    $news->setRecipient($this->main_user);
    $news->setText('foo loves bar');
    $news->save();

    // Getting first result in response
    $params = array(
      'last' => 0,
    );
    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertTrue(is_array($response->result));
    $this->assertTrue(count($response->result));
    $this->assertEqual($news->getId(), $response->result[0]->id);
    $params['last'] = $response->result[0]->id;

    // If there are no new news return shoud be empty with HTTP 304 status code
    $response = $this->get('social/news', $params);
    $this->assertResponse(304);
    $this->assertFalse(count($response->result));

    // Another one new news
    $news = $this->generator->news();
    $news->setRecipient($this->main_user);
    $news->setText('bar loves foo');
    $news->save();

    // Getting one new news now
    $response = $this->get('social/news', $params);
    $this->assertResponse(200);
    $this->assertTrue(count($response->result) == 1);
  }

  /**
   * @api description Get specified range of news, logic: $first < NEWS < $last
   * @api input param int first Lowest limit of range
   * @api input param int last Highest limit of range
   * @api result News[] - List of news in specified range
   */
  function testGetArchiveNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    // Adding new news
    $ids = array();
    for($i = 0; $i < 6; $i++) {
      $news = $this->generator->news();
      $news->setRecipient($this->main_user);
      $news->setText('foo loves bar');
      $news->save();
      $ids[] = $news->getId();
    }

    $params = array(
      'first' => $ids[1],
      'last' => $ids[4]
    );
    $response = $this->get('social/news', $params);
    $this->assertResponse(200);
    $this->assertTrue(count($response->result) == 2);
    $this->assertTrue($response->result[0]->id == $ids[2]);
    $this->assertTrue($response->result[1]->id == $ids[3]);
  }

  /**
   * @api description Get list of latest news (size is defined by application, by default is 50).
   * @api result News[] List of news
   */
  function testFirstGetNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    // Adding new news
    for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_news_count; $i++) {
      $news = $this->generator->news();
      $news->setRecipient($this->main_user);
      $news->setText('foo loves bar');
      $news->save();
    }

    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertTrue(count($response->result) == lmbToolkit::instance()->getConf('common')->default_news_count);
  }
}
