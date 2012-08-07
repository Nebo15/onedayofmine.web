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
class Moment extends lmbActiveRecord
{
  const IMAGE_ORIG = 'orig';
  const IMAGE_SMALL = '200x200';
  const IMAGE_BIG = '400x400';

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
    $moment->image_small = lmbToolkit::instance()->getStaticUrl($this->getImageSmall());
    $moment->image_big = lmbToolkit::instance()->getStaticUrl($this->getImageBig());
    $moment->image_shoot_time = $this->getImageShootTime();
    $moment->likes_count = $this->getLikesCount() ?: 0;
    $moment->ctime = $this->getCtime();

    return $moment;
  }

  function attachImage($filename_or_url, $content)
  {
    $extension = strtolower(substr($filename_or_url, strrpos($filename_or_url, '.')+1));
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getImageOrig());
    lmbFs::safeWrite($orig_file, $content);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageSmall());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 200, 'height' => 200));
    $helper->save($small_file);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageBig());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 400, 'height' => 400));
    $helper->save($small_file);
  }

  function getImageOrig()
  {
    return $this->getImagePath(self::IMAGE_ORIG);
  }

  function getImageSmall()
  {
    return $this->getImagePath(self::IMAGE_SMALL);
  }

  function getImageBig()
  {
    return $this->getImagePath(self::IMAGE_BIG);
  }

  function getImagePath($size_variation)
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
    return "/users/$user_id/days/$day_id/{$hash}_$size_variation.$ext";
  }
}
