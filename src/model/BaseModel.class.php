<?php
lmb_require('limb/net/src/lmbIp.class.php');

abstract class BaseModel extends lmbActiveRecord
{
  protected $_default_sort_params = array('id'=>'asc');

  function exportForApi()
  {
    return (object) $this->export();
  }

  protected function _onBeforeCreate()
  {
    $this->cip = lmbIp::encode(lmbIp::getRemoteIp());
  }

  protected function _onAfterUpdate()
  {
    $this->uip = lmbIp::encode(lmbIp::getRemoteIp());
  }

  protected function _getImageExtensionByMimeType($mime_type)
  {
    lmb_assert_true($mime_type);

    if(false !== strpos($mime_type, 'JPEG image data'))
      return 'jpeg';

    $exts = array(
      'image/jpeg' => 'jpeg',
      'image/png'  => 'png',
      'image/gif'  => 'gif',
    );

    if(!isset($exts[$mime_type]))
      throw new lmbException("Unknown mime-type '{$mime_type}'");

    return $exts[$mime_type];
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
    $hours = floor($timezone / 60);
    $minutes = $timezone - $hours * 60;
    return sprintf('%s+%02d:%02d', $date_time, $hours, $minutes);
  }
}
