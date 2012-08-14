<?php
mixin Imageable {
  protected $path_pattern;
  protected $save_path_prefix = '/users/';
  protected $image_sizes = array();

  function setPathPattern()
  {

  }

  function addImageSize($width = null, $height = null)
  {
    if(is_null($width) && is_null($height))
      throw new lmbException("Width or Height should be not empty.");

  }

  function attachImage($content)
  {
    $extension = lmbToolkit::instance()->getImageHelper()->getImageExtensionByFileContents($content);
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getImageOrig());
    lmbFs::safeWrite($this->save_path_prefix.$orig_file, $content);

    foreach ($this->image_sizes as $size) {
      $resized_file = lmbToolkit::instance()->getAbsolutePath($this->getImageSmall());
      $helper = new lmbConvertImageHelper($resized_file);
      $helper->resizeAndCropFrame($size);
      $helper->save($this->save_path_prefix.$resized_file);
    }
  }

  function showImages(stdClass $export)
  {
    $images = $this->getImages();
    foreach ($images as $image_width => $image) {
      $export->$image_width = $image;
    }
  }

  function getImages()
  {
    $result = [];
    foreach ($this->image_sizes as $size) {
      $result[$size['width']] = $this->getImage($size);
    }
    return $result;
  }

  function getImage(array $size)
  {
    if(!$this->getImageExt())
      return null;

    if(!$this->getId())
      return null;

    if(!$this->getUser() || !$this->getUser()->getId())
      return null;

    $user_id = $this->getUser()->getId();
    $hash = sha1('s0l7&p3pp$r'.$user_id.$this->getId());
    $ext = $this->getImageExt();

    $placeholders = [
      ':user_id'        => $this->getUser()->getId(),
      ':hash'           => sha1('s0l7&p3pp$r'.$this->getUser()->getId().$this->getId()), // .$this->getUser()->getCtime()
      ':file_extension' => $this->getImageExt(),
      ':file_size'      => $size['width'],
    ];

    return str_replace(array_keys($placeholders), $placeholders, $this->path_pattern);
  }
}
