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
   * @api input param int from ID of latest present in application news
   * @api input param int to ID of first present in application news
   * @api input param int limit news count
   * @api result News[limit] - List of news that was created after $last (if list is empty adittionally outputs HTTP code 304)
   */
  function testGetNewNews() {
    $this->main_user->save(); // Save user to have static ID
    $this->_loginAndSetCookie($this->main_user);

    $response = $this->get('social/news');
    $this->assertResponse(200);
    $this->assertEqual(0, count($response->result));

    // Adding new news
    $news1 = $this->generator->news(null, $this->main_user);
    $news1->save();
    $news2 = $this->generator->news(null, $this->main_user);
    $news2->save();
    $news3 = $this->generator->news(null, $this->main_user);
    $news3->save();
    $news4 = $this->generator->news(null, $this->main_user);
    $news4->save();

    $response = $this->get('social/news');
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(4, count($response->result));
      $this->assertEqual($news4->getId(), $response->result[0]->id);
      $this->assertEqual($news3->getId(), $response->result[1]->id);
      $this->assertEqual($news2->getId(), $response->result[2]->id);
      $this->assertEqual($news1->getId(), $response->result[3]->id);
    }

    // If there are no new news return shoud be empty with HTTP 304 status code
    $response = $this->get('social/news', array('from' => $news1->getId()));
    $this->assertResponse(304);
    $this->assertEqual(0, count($response->result));

    $response = $this->get('social/news', array('from' => $news4->getId()));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(3, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
      $this->assertEqual($news1->getId(), $response->result[2]->id);
    }

    $response = $this->get('social/news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(2, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
      $this->assertEqual($news2->getId(), $response->result[1]->id);
    }

    $response = $this->get('social/news', array(
      'from' => $news4->getId(),
      'to' => $news1->getId(),
      'limit' => 1
    ));
    if($this->assertResponse(200))
    {
      $this->assertTrue(is_array($response->result));
      $this->assertEqual(1, count($response->result));
      $this->assertEqual($news3->getId(), $response->result[0]->id);
    }
  }
}
