<?php
lmb_require('src/model/BaseModel.class.php');

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
  protected function _defineRelations()
  {
    $this->_has_one = array (
      'user_settings' => array (
        'field' => 'user_settings_id',
        'class' => 'UserSettings',
        'can_be_null' => true
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
  	$validator->addRequiredRule('pic_big');
  	$validator->addRequiredRule('pic_small');
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
    $result->pic_small = $this->pic_small;
    $result->pic_big = $this->pic_big;
    $result->birthday = $this->birthday;
    $result->occupation = $this->occupation;
    $result->location = $this->location;
    $result->followers_count = $this->getFollowers()->count();
    $result->following_count = $this->getFollowing()->count();
    $result->days_count = $this->getDays()->count();
    if(lmbToolkit::instance()->getUser() && $this->getId() != lmbToolkit::instance()->getUser()->getId()) {
      $result->is_followed = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $this);
      $result->is_follower = UserFollowing::isFollowing($this, lmbToolkit::instance()->getUser());
    }
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

  function getDaysWithLimitations($from_id = null, $to_id = null, $show_deleted = false)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    $days = $show_deleted ? $this->getAllDays() : $this->getDays();
    return $days->find(array('criteria' => $criteria))->paginate(0, 100);
  }

  function getFavouriteDaysWithLimitations($from_id = null, $to_id = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    return $this->getFavouriteDays()->find(array('criteria' => $criteria))->paginate(0, 100);
  }

  function getPicSmall()
  {
    return 'http://lorempixel.com/g/400/200/';
  }

  function getPicBig()
  {
    return 'http://lorempixel.com/g/400/200/';
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
}
