<?php
lmb_require('src/model/base/BaseModel.class.php');

class DeviceToken extends BaseModel
{
  protected function _defineRelations()
  {
    $this->_has_many = array (
      'notifications' => array ('field' => 'device_token_id', 'class' => 'DeviceNotification'),
    );
    $this->_many_belongs_to['user'] = array ('field' => 'user_id', 'class' => 'User');
  }

  static function findOneByToken($token)
  {
    return DeviceToken::findOne(array('criteria' => lmbSQLCriteria::equal('token', $token)));
  }
}
