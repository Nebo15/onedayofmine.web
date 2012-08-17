<?php
lmb_require('src/model/BaseModel.class.php');

abstract class ModelWithImage extends BaseModel
{
  function attachImage($content)
  {
    $extension = lmbToolkit::instance()->getImageHelper()->getImageExtensionByImageContent($content);
    $this->setImageExt($extension);

    $s3_conf = lmbToolkit::instance()->getConcreteAmazonServiceConfig('S3');
    $s3 = lmbToolkit::instance()->createAmazonService('S3');
    $is_s3_enabled = $s3_conf['enabled'];

    $orig_file = $this->_getSavePath();
    lmbFs::safeWrite($orig_file, $content);

    foreach ($this->_getConfig()['sizes'] as $size) {
      $resized_file = $this->_getSavePath($size);
      $helper = new lmbConvertImageHelper($orig_file);
      $helper->resizeAndCropFrame($size);
      $helper->save($resized_file);
      if($is_s3_enabled)
      {
        $s3->batch()->create_object($s3_conf['bucket'], $this->_getS3SavePath($size), array(
            'fileUpload' => $resized_file
        ));
      }
    }

    if($is_s3_enabled)
    {
      $response = $s3->batch()->send();
      if(!$response->areOK())
        throw new lmbException('Error on file uploading');

      foreach ($this->_getConfig()['sizes'] as $size) {
        $resized_file = $this->_getSavePath($size);
        lmbFs::rm($resized_file);
      }
      lmbFs::rm($orig_file);
    }

    return $orig_file;
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

  protected function _getSavePath($size = null)
  {
    return lmb_env_get('APP_DIR').DIRECTORY_SEPARATOR.$this->_getConfig()['save_path'].DIRECTORY_SEPARATOR.$this->getImage($size);
  }

  protected function _getS3SavePath($size = null)
  {
    return $this->getImage($size);
  }
}
