<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');
lmb_require('limb/imagekit/src/lmbConvertImageHelper.class.php');
lmb_require('limb/validation/src/rule/lmbValidValueRule.class.php');
lmb_require('src/model/UserFollowing.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/UserSettings.class.php');
lmb_require('src/model/News.class.php');
lmb_require('src/model/NewsRecipient.class.php');

/**
 * @api
 * @method string facebook_uid
 * @method void setFacebookUid(string $facebook_user_id)
 * @method string facebook_access_token
 * @method void setFacebookAccessToken(string $facebook_access_token)
 * @method string getTwitterUid()
 * @method string getTwitterAccessToken()
 * @static User findById(int $id)
 * @method void
 */
class User extends BaseModel
{
  use Imageable;

  const SEX_MALE = 'male';
  const SEX_FEMALE = 'female';

  protected $_db_table_name = 'user';

  public $name;
  public $sex;
  public $birthday;
  public $occupation;
  public $location;
  public $email;
  public $timezone;
  public $facebook_uid;
  public $facebook_access_token;
  public $facebook_profile_utime;
  public $twitter_access_token;
  public $current_day_id;
  public $user_settings_id;

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
    if(!$item = UserSettings::findById($this->user_settings_id))
    {
      $item = UserSettings::createDefault($this);
    }
    return $item;
  }

  /**
   * @param $current_day Day
   */
  function setCurrentDay($current_day)
  {
    $this->current_day_id = $current_day->id;
  }

  function getDays()
  {
    return Day::find(lmbSQLCriteria::equal('user_id', $this->id), array('id' => 'DESC'));
  }

  function getFavoriteDays()
  {
    return Day::find(lmbSQLCriteria::equal('user_id', $this->id), array('id' => 'DESC'));
  }

  function getDaysComments()
  {
    return DayComment::find(lmbSQLCriteria::equal('user_id', $this->id));
  }

  function getMomentsComments()
  {
    return MomentComment::find(lmbSQLCriteria::equal('user_id', $this->id));
  }

  function getDeviceTokens()
  {
    return DeviceToken::find(lmbSQLCriteria::equal('user_id', $this->id));
  }

  function getFollowingUsers()
  {
    $following = UserFollowing::find(lmbSQLCriteria::equal('user_id', $this->id));
    $users_ids = lmbArrayHelper::getColumnValues('id', $following);
    return self::findByIds($users_ids);
  }

  function getFollowersUsers()
  {
    $followers = UserFollowing::find(lmbSQLCriteria::equal('follower_user_id', $this->id));
    $users_ids = lmbArrayHelper::getColumnValues('id', $followers);
    return self::findByIds($users_ids);
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
    $criteria = lmbSQLCriteria::equal('user_id', $this->id);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return Day::find($criteria, ['id' => 'DESC'])->paginate(0, $limit);
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
    return Day::find($criteria)->paginate(0, $limit);
  }

  function getNews()
  {
    return News::find(lmbSQLCriteria::equal('recipient_id', $this->id));
  }

  function getNewsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('recipient_id', $this->id);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return News::find($criteria, ['id' => 'DESC'])->paginate(0, $limit);
  }

  static function findByFacebookAccessToken($facebook_access_token)
  {
    return User::findFirst(array('facebook_access_token = ?', $facebook_access_token));
  }

  /**
   * @param $facebook_uids_or_uid
   * @return User
   */
  static function findByFacebookUid($facebook_uids_or_uid)
  {
    if(is_array($facebook_uids_or_uid))
      return User::find(['criteria' => lmbSQLCriteria::in('facebook_uid', $facebook_uids_or_uid)]);
    else
      return User::findFirst(array('facebook_uid = ?', $facebook_uids_or_uid));
  }

  static function findByTwitterUid($twitter_uid)
  {
    return User::findFirst(array('twitter_uid = ?', $twitter_uid));
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $ids = lmbToolkit::instance()->getSearchService('users')->find($query, $from_id, $to_id, $limit);
    $users = self::findByIds($ids);
    $users = self::sortByIds($users, $ids);
    return $users;
  }

  static function findUsersWithOldDays()
  {
    $criteria = lmbSQLCriteria::less('day.ctime', time() - 24 * 60 * 60);
    $criteria->add(lmbSQLCriteria::isNotNull('current_day_id'));

    return User::find();

    $query = lmbARQuery :: create('Day')->eagerJoin('user')->addCriteria($criteria);

    $users = array();
    foreach($query->fetch() as $day)
      $users[] = $day->getUser();

    return new lmbCollection($users);
  }
}
