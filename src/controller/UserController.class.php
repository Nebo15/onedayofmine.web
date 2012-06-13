<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UserController extends BaseJsonController
{
  protected $_object_class_name = 'User';

  function doDays()
  {
    return $this->_answerOk(array(odMock::day(), odMock::day()));
  }

  function doFriendsInApp()
  {
    $friends = array();
    foreach($this->toolkit->getUser()->getGetUserFriendsInApplicationFromFb() as $friend)
      $friends[] = $friend->exportToSimpleObj();

    return $this->_answerOk($friends);
  }
}
