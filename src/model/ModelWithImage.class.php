<?php
lmb_require('src/model/BaseModel.class.php');

abstract class ModelWithImage extends BaseModel
{
  function attachImage($content)
  {
    $extension = lmbToolkit::instance()->getImageHelper()->getImageExtensionByImageContent($content);
    $this->setImageExt($extension);

    lmbFs::safeWrite($this->_getSavePath(), $content);

    if('jpeg' == $extension && 'Moment' == get_called_class())
      $this->_fillExifInfo($this->_getSavePath());

    foreach ($this->_getConvertionSizes() as $size)
    {
      $helper = new lmbConvertImageHelper($this->_getSavePath());
      $helper->resizeAndCropFrame($size);
      $helper->save($this->_getSavePath($size));
    }

    $is_s3_enabled = lmbToolkit::instance()->getConcreteAmazonServiceConfig('S3')['enabled'];
    if($is_s3_enabled)
    {
      $this->_sendImagesToS3();

      foreach ($this->_getAllSizes() as $size)
        lmbFs::rm($this->_getSavePath($size));
     }
  }

  protected function _sendImagesToS3()
  {
    $s3 = lmbToolkit::instance()->createAmazonService('S3');
    $bucket = lmbToolkit::instance()->getConcreteAmazonServiceConfig('S3')['bucket'];

    foreach ($this->_getAllSizes() as $size)
    {
      $s3->batch()->create_object($bucket, $this->_getS3SavePath($size), array(
        'fileUpload' => $this->_getSavePath($size),
        'acl' => AmazonS3::ACL_PUBLIC,
        'https' => false
      ));
    }

    $responses = $s3->batch()->send();

    if(!$responses->areOK())
      foreach($responses as $response)
        if(!$response->isOk())
          throw new lmbException('Error on file uploading: '.$response->body->Message);
  }

  protected function _fillExifInfo($image_file)
  {
    $helper = lmbToolkit::instance()->getImageHelper();
    $exif = $helper->getExifInfo($image_file);

    if(array_key_exists('GPS', $exif)) {
      $cords = $helper->exifGPSToDecemicalCords($exif);
      $this->setLocationLatitude($cords['latitude']);
      $this->setLocationLongitude($cords['longitude']);
    }

    if(array_key_exists('IFD0', $exif) && array_key_exists('DateTime', $exif['IFD0']))
      $this->setTime(strtotime($exif['IFD0']['DateTime']));
    elseif(array_key_exists('EXIF', $exif) && array_key_exists('DateTimeOriginal', $exif['EXIF']))
      $this->setTime(strtotime($exif['EXIF']['DateTimeOriginal']));
  }

  function showImages(stdClass $export)
  {
    foreach ($this->getImages() as $image_width => $image) {
      $export->$image_width = $image;
    }
  }

  function getImages()
  {
    $result = [];
    foreach ($this->_getConfig()['sizes'] as $size) {
      $result['image_'.$size['width']] = lmbToolkit::instance()->getStaticUrl($this->getImage($size));
    }
    return $result;
  }

  function getImage(array $size = null)
  {
    if(!$this->getImageExt())
      return null;

    if(!$this->getId())
      throw new lmbException("Can't create image path, because entity have no ID.", array('class' => get_called_class()));

    $placeholders = [
      ':id'             => $this->getId(),
      ':hash'           => sha1('s0l7&p3pp$r'.$this->getId()),
      ':file_extension' => $this->getImageExt(),
      ':image_width'    => count($size) ? $size['width'] : 'orig',
    ];

    $this->_getAdditionalPlaceholders($placeholders);

    return $this->_resolveRelativePath($placeholders);
  }

  protected function _getAdditionalPlaceholders(&$placeholders){}

  private function _resolveRelativePath(array $placeholders)
  {
    return str_replace(array_keys($placeholders), $placeholders, $this->_getConfig()['path']);
  }

  private function _getCommonConfig()
  {
    return lmbToolkit::instance()->getConf('images');
  }

  private function _getConfig()
  {
    return $this->_getCommonConfig()[get_called_class()];
  }

  protected function _getSavePath($size = null)
  {
    return lmb_env_get('APP_DIR').DIRECTORY_SEPARATOR.$this->_getCommonConfig()['save_path'].DIRECTORY_SEPARATOR.$this->getImage($size);
  }

  protected function _getS3SavePath($size = null)
  {
    return $this->getImage($size);
  }

  protected function _getAllSizes()
  {
    $sizes = $this->_getConfig()['sizes'];
    $sizes[] = array('width' => 'orig', 'height' => '');
    return $sizes;
  }

  protected function _getConvertionSizes()
  {
    return $this->_getConfig()['sizes'];
  }
}
