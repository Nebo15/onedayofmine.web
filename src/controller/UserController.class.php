<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UserControllerBase extends BaseJsonController
{
  protected $_object_class_name = 'User';

  function doFriendsInApp()
  {
    $answer = new stdClass();
    $answer->friends = array();
    foreach($this->toolkit->getUser()->getGetUserFriendsInApplicationFromFb() as $friend)
      $answer->friends[] = $friend->exportToSimpleObj();

    return $this->_answerOk($answer);
  }
}
