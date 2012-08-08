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
 * @method void
 */
class User extends BaseModel
{
  const USERPIC_ORIG = 'orig';
  const USERPIC_SMALL = '70x70';
  const USERPIC_BIG = '140x140';

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

  /**
   * @return SocialServicesProfileInterface
   */
  function getSocialProfile($provider = odSocialServices::PROVIDER_MULTI)
  {
    return lmbToolkit::instance()->getSocialServices()->getSocialProfile($this, $provider);
  }

  function exportForApi()
  {
    $result = new stdClass();
    $result->id = $this->id;
    $result->fb_uid = $this->fb_uid;
    $result->twitter_uid = $this->twitter_uid;
    $result->name = $this->name;
    $result->sex = $this->sex;
    $result->pic_small = lmbToolkit::instance()->getSiteUrl($this->getPicSmall());
    $result->pic_big = lmbToolkit::instance()->getSiteUrl($this->getPicBig());
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

  function attachImage($filename_or_url, $content)
  {
    $extension = strtolower(substr($filename_or_url, strrpos($filename_or_url, '.')+1));
    $this->setImageExt($extension);

    $orig_file = lmbToolkit::instance()->getAbsolutePath($this->getPicOrig());
    lmbFs::safeWrite($orig_file, $content);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getPicSmall());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 70, 'height' => 70));
    $helper->save($small_file);

    $small_file = lmbToolkit::instance()->getAbsolutePath($this->getPicBig());
    $helper = new lmbConvertImageHelper($orig_file);
    $helper->resizeAndCropFrame(array('width' => 140, 'height' => 140));
    $helper->save($small_file);
  }

  function getPicOrig()
  {
    return $this->getPicPath(User::USERPIC_ORIG);
  }

  function getPicSmall()
  {
    return $this->getPicPath(User::USERPIC_SMALL);
  }

  function getPicBig()
  {
    return $this->getPicPath(User::USERPIC_BIG);
  }

  function getPicPath($size_variation = User::USERPIC_ORIG)
  {
    $ext = $this->getImageExt();
    if(!$ext)
      return '';

    if(!$this->getId())
      throw new lmbException("Can't create image path, because user have no id");
    $user_id = $this->getId();
    $hash = sha1('s0l7&p3pp$r'.$user_id);
    return "users/$user_id/{$hash}_$size_variation.$ext";
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
