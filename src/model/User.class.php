<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.class.php');
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
  public $twitter_uid;
  public $twitter_access_token;
  public $twitter_access_token_secret;
	public $instagram_uid;
	public $instagram_token;
	public $flickr_uid;
	public $flickr_token;
  public $current_day_id;
  public $user_settings_id;
  public $ctime;
  public $utime;
  public $cip;

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
      $result->$image_width = $image ?: lmbToolkit::instance()->getStaticUrl("users/default_{$image_width}.png");
    }
    $result->birthday = $this->birthday;
    $result->occupation = $this->occupation;
    $result->location = $this->location;
    return $result;
  }

  function setSettings(UserSettings $settings)
  {
    $this->user_settings_id = $settings->id;
  }

  /**
   * @return UserSettings
   */
  function getSettings()
  {
    if(!$item = UserSettings::findById($this->user_settings_id))
    {
      $item = UserSettings::createDefault();
      $item->save();
      $this->user_settings_id = $item->id;
      $this->save();
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

	function getPublicDays()
	{
		$criteria = lmbSQLCriteria::equal('user_id', $this->id)
				->add(lmbSQLCriteria::equal('is_deleted', 0));
		return Day::find($criteria, ['id' => 'DESC']);
	}

  function getFavoriteDays()
  {
    $favorites = DayFavorite::find(lmbSQLCriteria::equal('user_id', $this->id));
    $days_ids = lmbArrayHelper::getColumnValues('day_id', $favorites);
    if(!$days_ids)
      return new lmbCollection();
    return Day::findByIds($days_ids);
  }

  function getDaysComments()
  {
    return DayComment::find(lmbSQLCriteria::equal('user_id', $this->id));
  }

  function getDayLikes()
  {
    return DayLike::find(lmbSQLCriteria::equal('user_id', $this->id), array('id' => 'DESC'));
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
    $following = UserFollowing::find(lmbSQLCriteria::equal('follower_user_id', $this->id));
    $users_ids = lmbArrayHelper::getColumnValues('user_id', $following);
    if(!$users_ids)
      return new lmbCollection();
    return self::findByIds($users_ids);
  }

  function getFollowersUsers()
  {
    $followers = UserFollowing::find(lmbSQLCriteria::equal('user_id', $this->id));
    $users_ids = lmbArrayHelper::getColumnValues('follower_user_id', $followers);
    if(!$users_ids)
      return new lmbCollection();
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
    $query = new lmbSelectQuery('day_favorite');
    $query->addField('day_id');
    $query->addCriteria(lmbSQLCriteria::equal('user_id', $this->id));
    $query->order('ctime', 'DESC');
    $ids = lmbArrayHelper::getColumnValues('day_id', $query->fetch());

    if($from_id)
      foreach($ids as $i => $id)
      {
        unset($ids[$i]);
        if($id == $from_id) break;
      }

    if($to_id)
    {
      $ids = array_reverse($ids);
      foreach($ids as $i => $id)
      {
        unset($ids[$i]);
        if($id == $to_id) break;
      }
      $ids = array_reverse($ids);
    }

    if(!$limit || $limit > 100)
      $limit = 100;
    $ids = array_slice($ids, 0, $limit);

    if(!count($ids))
      return new lmbCollection();

    $criteria = lmbSQLCriteria::in('id', $ids);
    return Day::find($criteria);
  }

  function getNews()
  {
    $query = new lmbSelectQuery('news_recipient');
    $query->addField('news_id');
    $query->addCriteria(lmbSQLCriteria::equal('user_id', $this->id));

    $result = $query->fetch();
    $ids = lmbArrayHelper::getColumnValues('news_id', $result);

    if(!count($ids))
      return new lmbCollection();

    return News::find(lmbSQLCriteria::in('id', $ids));
  }

  function getNewsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $query = new lmbSelectQuery('news_recipient');
    $query->addField('news_id');
    $query->addCriteria(lmbSQLCriteria::equal('user_id', $this->id));

    $result = $query->fetch();
    $ids = lmbArrayHelper::getColumnValues('news_id', $result);
    if(!count($ids))
      return new lmbCollection();

    $criteria = lmbSQLCriteria::in('id', $ids);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));

    return News::find($criteria, ['id' => 'DESC'])->paginate(0, $limit ?: 100);
  }

  function getActivityWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('sender_id', $this->id);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));

    return News::find($criteria, ['id' => 'DESC'])->paginate(0, $limit ?: 100);
  }

  function getCreatedNews()
  {
    $criteria = lmbSQLCriteria::equal('sender_id', $this->id);
    return News::find($criteria, ['id' => 'DESC']);
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
      return User::find(lmbSQLCriteria::in('facebook_uid', $facebook_uids_or_uid));
    else
      return User::findFirst(lmbSQLCriteria::equal('facebook_uid', $facebook_uids_or_uid));
  }

  static function findByTwitterUid($twitter_uid)
  {
    return User::findFirst(array('twitter_uid = ?', $twitter_uid));
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $ids = lmbToolkit::instance()->getSearchService('User')->find($query, $from_id, $to_id, $limit);
    if(!$ids)
      return [];
    $users = self::findByIds($ids);
    $users = self::sortByIds($users, $ids);
    return $users;
  }

  static function findUsersWithOldDays()
  {
    $criteria = lmbSQLCriteria::less('day.ctime', time() - 24 * 60 * 60);
    $criteria->add(lmbSQLCriteria::notEqual('user.current_day_id', '0'));

    $query = new lmbSelectQuery('day');
    $query
      ->addLeftJoin('user', 'id', 'day', 'user_id')
      ->addField('user.*')
      ->where($criteria);

    return User::findByQuery($query);
  }
}
