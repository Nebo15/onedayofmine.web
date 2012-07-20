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
   * @api description Get list of news that was created after specified news. SQL logic representation: SELECT ... FROM ... WHERE id > $last ORDER BY DESC LIMIT 100
   * @api input param int last ID of latest present in application news
   * @api result News[100] - List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)
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
   * @api description Get list of news that was created before specified news. SQL logic representation: SELECT ... FROM ... WHERE id < $first ORDER BY DESC LIMIT 100
   * @api input param int last ID of latest present in application news
   * @api result News[100] - List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)
   */
  function testGetOldNews() {
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
      'first' => $ids[3],
    );
    $response = $this->get('social/news', $params);
    $this->assertResponse(200);
    $this->assertTrue(count($response->result) == 3);
    $this->assertTrue($response->result[0]->id == $ids[2]); // pay attention to order
    $this->assertTrue($response->result[1]->id == $ids[1]);
    $this->assertTrue($response->result[2]->id == $ids[0]);
  }

  /**
   * @api description Get specified range of news. SQL logic representation: SELECT ... FROM ... WHERE $first < id AND id < $last ORDER BY DESC LIMIT 100
   * @api input param int last Highest limit of range
   * @api result News[100] - List of news in specified range
   */
  function testGetNewsRange() {
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
    $this->assertTrue($response->result[1]->id == $ids[2]); // pay attention, order is reversed
    $this->assertTrue($response->result[0]->id == $ids[3]);
  }

  /**
   * @api description Get list of latest news. SQL logic representation: SELECT ... FROM ... ORDER BY DESC LIMIT 100
   * @api result News[100] List of news
   */
  function testGetLastNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    // Adding new news
    $ids = array();
    for($i = 0; $i < lmbToolkit::instance()->getConf('common')->default_news_count*2; $i++) {
      $news = $this->generator->news();
      $news->setRecipient($this->main_user);
      $news->setText('foo loves bar');
      $news->save();
      $ids[] = $news->getId();
    }

    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertTrue(count($response->result) == lmbToolkit::instance()->getConf('common')->default_news_count);
    // change order
    rsort($ids);
    $this->assertTrue($response->result[0]->id == $ids[0]); // pay attention, order is reversed
    $this->assertTrue($response->result[1]->id == $ids[1]);
  }
}
