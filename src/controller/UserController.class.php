<?php
lmb_require('src/controller/JsonObjectController.class.php');
lmb_require('src/model/User.class.php');

class UserController extends JsonObjectController
{
  protected $_object_class_name = 'User';
}
