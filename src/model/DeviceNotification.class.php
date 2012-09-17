<?php

class DeviceNotification extends BaseModel
{
  protected function _defineRelations()
  {
    $this->_many_belongs_to['device_token'] = array ('field' => 'device_token_id', 'class' => 'DeviceToken');
  }

  static function findNotSended()
  {
    $criteria = lmbSQLCriteria::equal('is_sended', 0);
    return DeviceNotification::find(['criteria' => $criteria]);
  }
}
