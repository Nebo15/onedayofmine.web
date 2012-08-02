<?php
lmb_require('limb/imagekit/src/lmbImageKit.class.php');

class lmbConvertImageHelper
{
  /**
   * @var lmbAbstractImageConverter
   */
  protected $converter;

  function __construct($source_file, $save_original = true)
  {
    if($save_original)
    {
      $tmp_file = lmbFs::generateTmpFile('image_converting');
      lmbFs::cp($source_file, $tmp_file);
      $source_file = $tmp_file;
    }
    $this->converter = lmbImageKit :: load($source_file, '', lmb_env_get('IMAGE_LIBRARY', 'gd'));
    lmbFs::rm($source_file);
  }

  function save($dest_file, $quality = null)
  {
    $container = $this->converter->getContainer();
    $min = min($container->getWidth(), $container->getHeight());
    if($min <= 150)
      $quality = 95;
    elseif($min <= 300)
      $quality = 92;
    return $this->converter->save($dest_file, null, $quality);
  }

  function resizeFixedWidth($size)
  {
    if($this->_getWidth() > $size['width'])
    {
      $resize_params = array('width' => $size['width'], 'preserve_aspect_ratio' => true);
      $this->converter->apply('resize', $resize_params);
    }
  }

  function resizeFixedHeight($size)
  {
    if($this->_getHeight() > $size['height'])
    {
      $resize_params = array('height' => $size['height'], 'preserve_aspect_ratio' => true);
      $this->converter->apply('resize', $resize_params);
    }
  }

  function resizeFullFrame($size)
  {
    if($this->_getWidth() > $size['width'] || $this->_getHeight() > $size['height'])
    {
      if( ((float)$this->_getWidth()/$this->_getHeight()) > ((float)$size['width']/$size['height']) )
        $resize_params = array('width' => $size['width'], 'preserve_aspect_ratio' => true);
      else
        $resize_params = array('height' => $size['height'], 'preserve_aspect_ratio' => true);

      $this->converter->apply('resize', $resize_params);
    }
  }

  function resizePartialFrame($size)
  {
    $width = $this->converter->getContainer()->getWidth();
    $height = $this->converter->getContainer()->getHeight();

    if($width > $size['width'] || $height > $size['height'])
    {
      if( ((float)$width/$height) < ((float)$size['width']/$size['height']) )
        $resize_params = array('width' => $size['width'], 'preserve_aspect_ratio' => true);
      else
        $resize_params = array('height' => $size['height'], 'preserve_aspect_ratio' => true);

      $this->converter->apply('resize', $resize_params);
    }
  }

  function resizeAndCropFixedWidth($size)
  {
    $this->resizeFixedWidth($size);
    $this->cropFixedHeight($size);
  }

  function resizeAndCropFixedHeight($size)
  {
    $this->resizeFixedHeight($size);
    $this->cropFixedWidth($size);
  }

  function resizeAndCropFrame($size)
  {
    $this->resizePartialFrame($size);

    if($this->converter->getContainer()->getWidth() > $size['width'])
      $this->cropFixedWidth($size);

    if($this->converter->getContainer()->getHeight() > $size['height'])
      $this->cropFixedHeight($size);
  }

  function cropByCoords($source_file, $crop_params, $quality = null)
  {
    self :: save(lmbImageKit :: load($source_file, '', self::getUsedImageLibrary())->apply('crop', $crop_params), $source_file, $quality);
    return $source_file;
  }

  function resizeAndCropByCoords($source_file, $params, $quality = null)
  {
    $coords = $params['coords'];
    $size = $params['size'];

    $source_file = self :: cropByCoords($source_file, $coords, 100);
    $source_file = self :: resizeFullFrame($source_file, $size, $quality);

    return $source_file;
  }

  function cropFixedWidth($size)
  {
    if($this->_getWidth() > $size['width'])
    {
      $crop_params = array(
        'width' => $size['width'], 'height' => $size['height'],
        'x' => ($this->_getWidth() - $size['width']) / 2, 'y' => 0,
      );
      $this->converter->apply('crop', $crop_params);
    }
  }

  function cropFixedHeight($size)
  {
    if($this->_getHeight() > $size['height'])
    {
      $crop_params = array(
        'width' => $size['width'], 'height' => $size['height'],
        'x' => 0, 'y' => ($this->_getHeight() - $size['height']) / 2,
      );
      $this->converter->apply('crop', $crop_params);
    }
  }

  protected function _getWidth()
  {
    static $width;
    if(!$width)
      $width = $this->converter->getContainer()->getWidth();
    return $width;
  }

  protected function _getHeight()
  {
    static $height;
    if(!$height)
      $height = $this->converter->getContainer()->getHeight();;
    return $height;
  }
}
