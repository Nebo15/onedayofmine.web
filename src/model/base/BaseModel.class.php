<?php
lmb_require('src/model/base/odLightAR.class.php');
lmb_require('limb/net/src/lmbIp.class.php');
lmb_require('limb/validation/src/rule/lmbValidValueRule.class.php');

abstract class BaseModel extends odLightAR
{
  protected $_default_sort_params = array('id'=>'asc');

  function exportForApi(array $properties = null)
  {
    $export = array();
    foreach($properties ?: $this->getPropertiesNames() as $property)
    {
      if(!is_object($this->$property))
        $export[$property] = $this->$property;
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
    return array($date->getTimestamp() + $date->getOffset() * 2, $date->getOffset() / 60);
  }

  static function stampToIso($stamp, $timezone)
  {
    $date = DateTime::createFromFormat('U', $stamp - $timezone * 60, new DateTimeZone('UTC'));
    $date_time = strstr($date->format(Datetime::ISO8601), '+', true);
    $sign = $timezone < 0 ? '-' : '+';
    $timezone = abs($timezone);
    $hours = floor($timezone / 60);
    $minutes = $timezone - $hours * 60;
    return sprintf('%s%s%02u:%02d', $date_time, $sign, $hours, $minutes);
  }

  static function sortByIds($data, $ids)
  {
    if(!is_array($ids) || !count($ids))
      return $data;

    $result = [];

    foreach ($ids as $id)
    {
      foreach ($data as $item)
      {
        if($item->id == $id)
        {
          $result[] = $item;
          break;
        }
      }
    }

    return $result;
  }
}
