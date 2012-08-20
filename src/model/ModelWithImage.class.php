<?php
lmb_require('src/model/BaseModel.class.php');

abstract class ModelWithImage extends BaseModel
{
  function attachImage($content)
  {
    $extension = lmbToolkit::instance()->getImageHelper()->getImageExtensionByImageContent($content);
    $this->setImageExt($extension);

    lmbFs::safeWrite($this->_getOrigSavePath(), $content);

    foreach ($this->_getConfig()['sizes'] as $size)
    {
      $helper = new lmbConvertImageHelper($this->_getOrigSavePath());
      $helper->resizeAndCropFrame($size);
      $helper->save($this->_getSavePath($size));

      if('jpeg' == $extension && 'Moment' == get_called_class())
        $this->_fillExifInfo();
    }
  }

  protected function _fillExifInfo()
  {
    $helper = lmbToolkit::instance()->getImageHelper();
    $exif = $helper->getExifInfo($this->_getOrigSavePath());

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
      throw new Exception("Can't create image path, because entity have no ID.", array('class' => get_called_class()));

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

  private function _getConfig()
  {
    return lmbToolkit::instance()->getConf('images')[get_called_class()];
  }

  protected function _getOrigSavePath()
  {
    return $this->_getSavePath();
  }

  protected function _getSavePath($size = null)
  {
    return lmb_env_get('APP_DIR').DIRECTORY_SEPARATOR.$this->_getConfig()['save_path'].DIRECTORY_SEPARATOR.$this->getImage($size);
  }

  protected function _getS3SavePath($size = null)
  {
    return $this->getImage($size);
  }
}
