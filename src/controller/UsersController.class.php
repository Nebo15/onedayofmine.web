<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UsersController extends BaseJsonController
{
  protected $check_auth = false;

  function doDays()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User with id {$this->request->id} not found");

    $answer = array();
    foreach($user->getDays() as $day)
      $answer[] = $day->exportForApi();

    return $this->_answerOk($answer);
  }
}
