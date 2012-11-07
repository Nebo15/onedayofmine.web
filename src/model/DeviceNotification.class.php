<?php

class DeviceNotification extends BaseModel
{
  protected $_db_table_name = 'device_notification';

  public $device_token_id;
  public $text;
  public $icon;
  public $sound;
  public $is_sended;
  public $ctime;

  function setDeviceToken(DeviceToken $token)
  {
    $this->device_token_id = $token->id;
  }

  static function findNotSended()
  {
    $criteria = lmbSQLCriteria::equal('is_sended', 0);
    return DeviceNotification::find($criteria);
  }
}
