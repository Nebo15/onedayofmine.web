<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');
lmb_require('limb/imagekit/src/lmbConvertImageHelper.class.php');
lmb_require('limb/validation/src/rule/lmbValidValueRule.class.php');

/**
 * @api
 * @method string getFacebookUid()
 * @method void setFacebookUid(string $facebook_user_id)
 * @method string getFacebookAccessToken()
 * @method void setFacebookAccessToken(string $facebook_access_token)
 * @method string getTwitterUid()
 * @method string getTwitterAccessToken()
 * @method void
 */
class User extends BaseModel
{
  use Imageable;

  const SEX_MALE = 'male';
  const SEX_FEMALE = 'female';

  protected function _defineRelations()
  {
    $this->_has_one = array (
      'user_settings' => array (
        'field' => 'user_settings_id',
        'class' => 'UserSettings',
        'can_be_null' => true,
        'cascade_delete' => false
      ),
      'current_day' => array (
        'field' => 'current_day_id',
        'class' => 'Day',
        'can_be_null' => true,
        'cascade_delete' => false
      )
    );
    $this->_has_many = array (
      'days' => array (
        'field' => 'user_id',
        'class' => 'Day',
      ),
      'days_comments'    => array ('field' => 'user_id', 'class' => 'DayComment'),
      'moments_comments' => array ('field' => 'user_id', 'class' => 'MomentComment'),
      'activities'       => array ('field' => 'sender_id', 'class' => 'News'),
      'created_news'     => array ('field' => 'sender_id', 'class' => 'News'),
      'day_likes'        => array ('field' => 'user_id', 'class' => 'DayLike'),
      'moment_likes'     => array ('field' => 'user_id', 'class' => 'MomentLike'),
      'device_tokens'      => array ('field' => 'user_id', 'class' => 'DeviceToken'),
    );
    $this->_has_many_to_many = array(
      'favorite_days' => array(
        'field' => 'user_id',
        'foreign_field' => 'day_id',
        'table' => 'day_favorite',
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
      'news' => array(
        'field' => 'user_id',
        'foreign_field' => 'news_id',
        'table' => 'news_recipient',
        'class' => 'News'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('name');
    $validator->addRequiredRule('facebook_uid');
    $validator->addRequiredRule('facebook_access_token');
    $validator->addRequiredRule('facebook_profile_utime');
    $validator->addRequiredRule('timezone');
    $validator->addRequiredRule('sex');
    $validator->addRule(new lmbValidValueRule('sex', array_values(self::getSexTypes())), 'Wrong sex value');
    $validator->addRequiredRule('birthday');
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $result = new stdClass();
    $result->id = $this->id;
    $result->name = $this->name;
    $result->sex = $this->sex;
    foreach ($this->getImages() as $image_width => $image) {
      $result->$image_width = $image ?: lmbToolkit::instance()->getStaticUrl("default_{$image_width}.png");
    }
    $result->birthday = $this->birthday;
    $result->occupation = $this->occupation;
    $result->location = $this->location;
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

  static function getSexTypes()
  {
    return array(
      self::SEX_MALE => 'male',
      self::SEX_FEMALE => 'female',
    );
  }

  function getDaysWithLimitations($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getDays()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC')
    ))->paginate(0, $limit);
  }

  function getFavoriteDaysWithLimitations($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getFavoriteDays()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC'),
    ))->paginate(0, $limit);
  }

  function getActivitiesWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getActivities()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC'),
    ))->paginate(0, $limit);
  }

  static function findByFacebookAccessToken($facebook_access_token)
  {
    return User::findOne(array('facebook_access_token = ?', $facebook_access_token));
  }

  static function findByFacebookUid($facebook_uid)
  {
    return User::findOne(array('facebook_uid = ?', $facebook_uid));
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

  static function findUsersWithOldDays()
  {
    $criteria = lmbSQLCriteria::less('day.ctime', time() - 24 * 60 * 60);
    $criteria->add(lmbSQLCriteria::isNotNull('current_day_id'));

    $query = lmbARQuery :: create('Day')->eagerJoin('user')->addCriteria($criteria);

    $users = array();
    foreach($query->fetch() as $day)
      $users[] = $day->getUser();

    return new lmbCollection($users);
  }
}
