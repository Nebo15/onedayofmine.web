<?php
lmb_require('tests/cases/AcceptanceTestCase.class.php');


class DayAcceptanceTest extends AcceptanceTestCase
{
  function testDay_Begin()
  {
    $this->post('day/begin');
    $this->assertResponse(403);

    $this->_loginAndSetCookie($this->main_user);
    $errors = $this->post('day/begin');
    $this->assertResponse(200);
    $this->assertTrue('array', gettype($errors));
    $this->assertEqual(2, count($errors));
    $this->assertEqual('title', $errors[0]->fields->Field);
    $this->assertEqual('description', $errors[1]->fields->Field);

    $user = User::findOne();

    $params = array(
      'title' => $this->_string(4),
      'description' => $this->_string(8),
      'tags' => array('tag1', 'tag2')
    );
    $day = $this->post('day/begin', $params);
    $this->assertEqual($params['title'], $day->title);
    $this->assertEqual($params['description'], $day->description);
    $this->assertEqual($params['tags'], $day->tags);
    $this->assertEqual($user->getId(), $day->user_id);
    $this->assertTrue($day->ctime);
    $this->assertTrue($day->utime);
    $this->assertTrue($day->cip);
  }

  //TODO
  function testDay_Item()
  {
    $this->get('day/item', array('id' => 42));
  }

  //TODO
  function testDay_Items()
  {
    $this->get('day/items', array('ids' => array(42, 42)));
  }

  //TODO
  function testDay_Update()
  {
    $this->post('day/update', array(
        'day_id' => 42,
        'tags' => array('tag1', 'tag2'),
        'top_moment_id' => 111)
    );
  }

  //TODO
  function testDay_AddMoment()
  {

  }

  //TODO
  function testDay_Comment()
  {

  }

  //TODO
  function testDay_End()
  {
    $this->post('day/end', array(
      'day_id' => 42
    ));
  }

  function testDay_Share()
  {

  }
}
