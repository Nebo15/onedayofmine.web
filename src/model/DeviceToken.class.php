<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/DeviceNotification.class.php');

class DeviceToken extends BaseModel
{
  protected $_db_table_name = 'device_token';

  protected $user;
  public $user_id;
  public $token;
  public $ctime;
  public $logins_count;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user_id');
    $validator->addRequiredRule('token');
    return $validator;
  }

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }

  static function findOneByToken($token)
  {
    return DeviceToken::findFirst(lmbSQLCriteria::equal('token', $token));
  }
}
