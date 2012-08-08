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

  protected function getImageExt()
  {
    return 'jpeg';
  }

  protected function _getImageExtensionByMimeType($mime_type)
  {
    lmb_assert_true($mime_type);

    $exts = array(
      'image/jpeg' => 'jpg',
      'image/png'  => 'png',
      'image/gif'  => 'gif',
      'JPEG image data, JFIF standard 1.02, comment: "*"' => 'jpg',
    );

    if(!isset($exts[$mime_type]))
      throw new lmbException("Unknown mime-type '{$mime_type}'");

    return $exts[$mime_type];
  }
}
