<?php
lmb_require('src/controller/JsonController.class.php');
lmb_require('src/model/User.class.php');

class UserController extends JsonController
{
  protected $_object_class_name = 'User';

  function doFriendsInApp()
  {
    return $this->_answer(
      $this->toolkit
        ->getUserFacebook()
        ->makeQuery(User::getFqlForGetUserFriendsInApplication())
    );
  }
}
