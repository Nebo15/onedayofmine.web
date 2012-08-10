<?php

/**
 * @api
 * @method string getFbUid()
 * @method void setFbUid(string $fb_user_id)
 * @method string getFbAccessToken()
 * @method string getDay()
 * @method string getDayId()
 * @method string getDescription()
 * @method void setFbAccessToken(string $fb_access_token)
 */
class Moment extends BaseModel
{
  const IMAGE_ORIG = 'orig';
  const IMAGE_SMALL = '266x266';
  const IMAGE_BIG = '532x532';

  protected $_db_table_name = 'moment';
  protected $_default_sort_params = array('id'=>'asc');
  protected $_lazy_attributes = array('description');

  protected function _defineRelations()
  {
    $this->_has_many = array (
      'comments' => array ('field' => 'moment_id', 'class' => 'MomentComment'),
    );
    $this->_many_belongs_to = array (
      'day' => array ('field' => 'day_id', 'class' => 'Day')
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredObjectRule('day', 'Day');
    return $validator;
  }

  function exportForApi()
  {
    $moment = new stdClass();
    $moment->id = $this->getId();
    $moment->day_id = $this->getDayId();
    $moment->description = $this->getDescription();
    $moment->image_266 = lmbToolkit::instance()->getStaticUrl($this->getImageSmall(true));
    $moment->image_532 = lmbToolkit::instance()->getStaticUrl($this->getImageBig(true));
    $moment->time = self::stampToIso($this->getTime(), $this->getTimezone());
    $moment->likes_count = $this->getLikesCount() ?: 0;
    $moment->ctime = $this->getCtime();

    return $moment;
  }

  function attachImage($content)
  {
    $extension = $this->_getImageExtensionByMimeType((new finfo())->buffer($content, FILEINFO_MIME_TYPE));
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getImageOrig());
    lmbFs::safeWrite($orig_file, $content);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageSmall());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 266, 'height' => 266));
    $helper->save($small_file);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageBig());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 532, 'height' => 532));
    $helper->save($small_file);
  }

  function getImageOrig($static = false)
  {
    return $this->getImagePath(self::IMAGE_ORIG, $static);
  }

  function getImageSmall($static = false)
  {
    return $this->getImagePath(self::IMAGE_SMALL, $static);
  }

  function getImageBig($static = false)
  {
    return $this->getImagePath(self::IMAGE_BIG, $static);
  }

  function getImagePath($size_variation, $static = false)
  {
    if(!$this->getImageExt())
      return '';
    if(!$this->getId())
      throw new lmbException("Can't create image path, because moment have no id");
    if(!$this->getDayId())
      throw new lmbException("Can't create image path, because moment have no DAY id");
    if(!$this->getDay()->getUser() || !$this->getDay()->getUser()->getId())
      throw new lmbException("Can't create image path, because moment have no user");
    $user_id = $this->getDay()->getUser()->getId();
    $day_id = $this->getDayId();
    $hash = sha1('s0l7&p3pp$r'.$user_id.$day_id.$this->getId());
    $ext = $this->getImageExt();

    $path = "{$user_id}/days/{$day_id}/{$hash}_{$size_variation}.{$ext}";

    if(!$static)
      $path = "users/{$path}";

    return $path;
  }
}
