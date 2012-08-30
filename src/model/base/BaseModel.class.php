<?php
lmb_require('limb/net/src/lmbIp.class.php');

abstract class BaseModel extends lmbActiveRecord
{
  protected $_default_sort_params = array('id'=>'asc');

  function exportForApi(array $properties = null)
  {
    $export = array();
    foreach($properties ?: $this->getPropertiesNames() as $property)
    {
      if(!is_object($this->get($property)))
        $export[$property] = $this->get($property);
    }
    return (object) $export;
  }

  protected function _onBeforeCreate()
  {
    $this->cip = lmbIp::encode(lmbIp::getRemoteIp());
  }

  protected function _onAfterUpdate()
  {
    $this->uip = lmbIp::encode(lmbIp::getRemoteIp());
  }

  static function isoToStamp($iso)
  {
    $date = DateTime::createFromFormat(DateTime::ISO8601, $iso);
    return array($date->getTimestamp(), $date->getOffset() / 60);
  }

  static function stampToIso($stamp, $timezone)
  {
    $date = DateTime::createFromFormat('U', $stamp + $timezone * 60, new DateTimeZone('UTC'));
    $date_time = strstr($date->format(Datetime::ISO8601), '+', true);
    $sign = $timezone < 0 ? '-' : '+';
    $timezone = abs($timezone);
    $hours = floor($timezone / 60);
    $minutes = $timezone - $hours * 60;
    return sprintf('%s%s%02u:%02d', $date_time, $sign, $hours, $minutes);
  }
}
