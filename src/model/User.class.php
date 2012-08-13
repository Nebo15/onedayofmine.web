<?php
lmb_require('src/model/BaseModel.class.php');
lmb_require('limb/imagekit/src/lmbConvertImageHelper.class.php');

/**
 * @api
 * @method string getFbUid()
 * @method void setFbUid(string $fb_user_id)
 * @method string getFbAccessToken()
 * @method void setFbAccessToken(string $fb_access_token)
 * @method string getTwitterUid()
 * @method UserSettings getSettings()
 * @method void
 */
class User extends BaseModel
{
  const IMAGE_ORIG = 'orig';
  const IMAGE_SMALL = '36x36';
  const IMAGE_BIG = '72x72';

  protected function _defineRelations()
  {
    $this->_has_one = array (
      'user_settings' => array (
        'field' => 'user_settings_id',
        'class' => 'UserSettings',
        'can_be_null' => true,
        'cascade_delete' => false
      )
    );
    $this->_has_many = array (
      'days' => array (
        'field' => 'user_id',
        'class' => 'Day',
        'criteria' =>'`day`.`is_deleted` = 0'
      ),
      'all_days' => array (
        'field' => 'user_id',
        'class' => 'Day',
      ),
      'days_comments' => array ('field' => 'user_id', 'class' => 'DayComment'),
      'moments_comments' => array ('field' => 'user_id', 'class' => 'MomentComment'),
      'news' => array ('field' => 'recipient_id', 'class' => 'News'),
      'created_news' => array ('field' => 'user_id', 'class' => 'News'),
    );
    $this->_has_many_to_many = array(
      'favourite_days' => array(
        'field' => 'user_id',
        'foreign_field' => 'day_id',
        'table' => 'day_favourite',
        'class' => 'Day',
        'criteria' => '`day`.`is_deleted` = 0'),
      'followers' => array(
        'field' => 'user_id',
        'foreign_field' => 'follower_user_id',
        'table' => 'user_following',
        'class' => 'User'),
      'following' => array(
        'field' => 'follower_user_id',
        'foreign_field' => 'user_id',
        'table' => 'user_following',
        'class' => 'User'),
    );
  }

  protected function _createValidator()
  {
  	$validator = new lmbValidator();
  	$validator->addRequiredRule('name');
    $validator->addRequiredRule('email');
  	$validator->addRequiredRule('fb_uid');
  	$validator->addRequiredRule('fb_access_token');
  	$validator->addRequiredRule('fb_profile_utime');
  	$validator->addRequiredRule('timezone');
  	$validator->addRequiredRule('sex');
  	$validator->addRequiredRule('birthday');
  	return $validator;
  }

  function exportForApi()
  {
    $result = new stdClass();
    $result->id = $this->id;
    $result->fb_uid = $this->fb_uid;
    $result->twitter_uid = $this->twitter_uid;
    $result->name = $this->name;
    $result->sex = $this->sex;
    $result->image_36 = lmbToolkit::instance()->getStaticUrl($this->getImageSmall(true)) ?: lmbToolkit::instance()->getStaticUrl("default_36.png");
    $result->image_72 = lmbToolkit::instance()->getStaticUrl($this->getImageBig(true)) ?: lmbToolkit::instance()->getStaticUrl("default_72.png");
    $result->birthday = $this->birthday;
    $result->occupation = $this->occupation;
    $result->location = $this->location;
    $result->followers_count = $this->getFollowers()->count();
    $result->following_count = $this->getFollowing()->count();
    $result->days_count = $this->getDays()->count();
    return $result;
  }

  function setSettings(UserSettings $settings)
  {
    $this->setUserSettings($settings);
  }

  function getSettings()
  {
    if(!$item = $this->getUserSettings())
    {
      $item = UserSettings::createDefault($this);
    }
    return $item;
  }

  function getDaysWithLimitations($from_id = null, $to_id = null, $limit = null, $show_deleted = false)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    $days = $show_deleted ? $this->getAllDays() : $this->getDays();
    return $days->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC')
    ))->paginate(0, $limit);
  }

  function getFavouriteDaysWithLimitations($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getFavouriteDays()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC'),
    ))->paginate(0, $limit);
  }

  function attachImage($content)
  {
    $extension = $this->_getImageExtensionByMimeType((new finfo())->buffer($content, FILEINFO_MIME_TYPE));
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getImageOrig());
    lmbFs::safeWrite($orig_file, $content);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageSmall());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 36, 'height' => 36));
    $helper->save($small_file);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getImageBig());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 72, 'height' => 72));
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

  function getImagePath($size_variation = User::IMAGE_ORIG, $static = false)
  {
    $ext = $this->getImageExt();
    if(!$ext)
      return '';

    if(!$this->getId())
      throw new lmbException("Can't create image path, because user have no id");
    $user_id = $this->getId();
    $hash = sha1('s0l7&p3pp$r'.$user_id);

    $path = "{$user_id}/{$hash}_{$size_variation}.{$ext}";

    if(!$static)
      $path = "users/{$path}";

    return $path;
  }

  static function findByFbAccessToken($fb_access_token)
  {
    return User::findOne(array('fb_access_token = ?', $fb_access_token));
  }

  static function findByFbUid($fb_uid)
  {
    return User::findOne(array('fb_uid = ?', $fb_uid));
  }

  static function findByTwitterUid($twitter_uid)
  {
    return User::findOne(array('twitter_uid = ?', $twitter_uid));
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::like('name', '%'.$query.'%');
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));

    return User::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'ASC')
    ));
  }
}
