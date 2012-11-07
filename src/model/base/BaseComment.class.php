<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseComment extends BaseModel
{
  public $user_id;

  function setUser($user)
  {
    $this->user_id = $user->id;
  }

  function getUser()
  {
    return User::findById($this->user_id);
  }

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->id;
    $export->text = $this->text;
    return $export;
  }
}
