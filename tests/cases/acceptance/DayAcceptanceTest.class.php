<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class DayAcceptanceTest extends odAcceptanceTestCase
{
  function testBegin_Negative()
  {
    $this->post('day/begin');
    $this->assertResponse(400);

    $this->_loginAndSetCookie($this->main_user);

    $this->get('day/begin');
    $this->assertResponse(405);

    $errors = $this->post('day/begin')->errors;
    $this->assertResponse(400);
    $this->assertEqual('array', gettype($errors));
    $this->assertTrue(0 < count($errors));
  }

  /**
   *@example
   */
  function testBegin()
  {
    $this->_loginAndSetCookie($this->main_user);

    $user = User::findOne();

    $params = array(
      'title' => $this->generator->string(4),
      'description' => $this->generator->string(8),
      'tags' => array('tag1', 'tag2')
    );
    $day = $this->post('day/begin', $params)->result;
    $this->assertResponse(200);
    $this->assertEqual($params['title'], $day->title);
    $this->assertEqual($params['description'], $day->description);
    $this->assertEqual($params['tags'], $day->tags);
    $this->assertEqual($user->getId(), $day->user_id);
    $this->assertTrue($day->ctime);
    $this->assertTrue($day->utime);
    $this->assertTrue($day->cip);
  }

  function testItem()
  {
    $this->_loginAndSetCookie($this->main_user);
    $day = $this->get('day/item', array('id' => 42))->result;
    $this->assertResponse(200);
    $this->assertTrue($day->id);
    $this->assertTrue($day->title);
    $this->assertTrue($day->img_url);
    $this->assertTrue($day->description);
    $this->assertTrue($day->ctime);
  }

  function testItems()
  {
    $this->_loginAndSetCookie($this->main_user);
    $days = $this->get('day/items', array('ids' => array(42, 42)))->result;
    $this->assertResponse(200);
    foreach($days as $day)
    {
      $this->assertTrue($day->id);
      $this->assertTrue($day->title);
      $this->assertTrue($day->img_url);
      $this->assertTrue($day->description);
      $this->assertTrue($day->ctime);
    }
  }

  function testUpdate()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/update', array(
        'day_id' => 42,
        'tags' => array('tag1', 'tag2'),
        'top_moment_id' => 111)
    );
    $this->assertResponse(200);
  }

  function testAddMoment()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/add_moment', array(
      ''
    ));
    $this->assertResponse(200);
  }

  function testComment()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/comment', array(
      'text' => 'comment text'
    ));
    $this->assertResponse(200);
  }

  function testEnd()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/end');
    $this->assertResponse(200);
  }

  function testShare()
  {
    $this->_loginAndSetCookie($this->main_user);
    $this->post('day/share');
    $this->assertResponse(200);
  }
}
