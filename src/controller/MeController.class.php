<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class MeController extends BaseJsonController
{
  protected $_object_class_name = 'User';
  protected $check_auth = false;

  function doDays()
  {
    $id = $this->request->get('id');
    if(!$id)
    {
      if(!$this->toolkit->getUser())
        return $this->_answerUnauthorized();
      $user = $this->toolkit->getUser();
    }
    else
    {
      if(!$user = User::findById($id))
        return $this->_answerNotFound("User with id $id not found");
    }

    $answer = array();
    foreach($user->getDays() as $day)
      $answer[] = $day->exportForApi();

    return $this->_answerOk($answer);
  }

  function doFriendsInApp()
  {
    if(!$this->toolkit->getUser())
      $this->_answerUnauthorized();
    $friends = array();
    foreach($this->toolkit->getUser()->getUserFriendsInApplicationFromFb() as $friend)
      $friends[] = $friend->exportForApi();

    return $this->_answerOk($friends);
  }
}
