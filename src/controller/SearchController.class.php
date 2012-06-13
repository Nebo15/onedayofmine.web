<?php
lmb_require('src/controller/BaseJsonController.class.php');

class SearchController extends BaseJsonController
{
  protected $check_auth = false;

  function doSuggest()
  {
    return $this->_answerOk(array('foo1', 'foo2'));
  }

  function doText()
  {
    return $this->_answerOk(array(
      'users' => array(odMock::user()),
      'days' => array(odMock::day()),
      'day_comments' => array(odMock::dayComment()),
      'moments' => array(odMock::moment()),
      'moment_comments' => array(odMock::momentComment())
    ));
  }
}
