<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.class.php');
lmb_require('limb/imagekit/src/lmbConvertImageHelper.class.php');
lmb_require('limb/validation/src/rule/lmbValidValueRule.class.php');
lmb_require('limb/web_app/src/validation/rule/lmbUniqueTableFieldRule.class.php');
lmb_require('src/model/UserFollowing.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/UserSettings.class.php');
lmb_require('src/model/News.class.php');
lmb_require('src/model/NewsRecipient.class.php');
lmb_require('limb/dbal/src/query/lmbUpdateQuery.class.php');

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

	public $invitation_id, $current_day_id, $user_settings_id;
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

  public $ctime;
  public $utime;
  public $cip;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('name');
    $validator->addRequiredRule('facebook_uid');
	  if($this->isNew())
	    $validator->addRule(new lmbUniqueTableFieldRule('facebook_uid', 'user'));
    $validator->addRequiredRule('facebook_access_token');
	  if($this->isNew())
		  $validator->addRule(new lmbUniqueTableFieldRule('facebook_access_token', 'user'));
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

	function setInvitation(Invitation $invitation)
	{
		$this->invitation_id = $invitation->id;
	}

	/**
	 * @return Invitation
	 */
	function getInvitation()
	{
		return Invitation::findById($this->invitation_id);
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

  function getFollowingUsers($from_user_id = null, $to_user_id = null, $limit = null)
  {
	  $criteria = lmbSQLCriteria::equal('follower_user_id', $this->id);
	  if($from_user_id)
		  $criteria->add(lmbSQLCriteria::less('user_id', $from_user_id));
	  if($to_user_id)
		  $criteria->add(lmbSQLCriteria::greater('user_id', $to_user_id));
	  if($limit > 100 || $limit < 0)
		  $limit = 100;
    $following = UserFollowing::find($criteria, ['user_id' => 'DESC']);
	  if($limit)
		  $following->paginate(0, $limit);
    $users_ids = lmbArrayHelper::getColumnValues('user_id', $following);
    if(!$users_ids)
      return new lmbCollection();
    return self::findByIds($users_ids);
  }

  function getFollowersUsers($from_user_id = null, $to_user_id = null, $limit = null)
  {
	  $criteria = lmbSQLCriteria::equal('user_id', $this->id);
	  if ($from_user_id)
		  $criteria->add(lmbSQLCriteria::less('follower_user_id', $from_user_id));
	  if ($to_user_id)
		  $criteria->add(lmbSQLCriteria::greater('follower_user_id', $to_user_id));
	  if ($limit > 100 || $limit < 0)
		  $limit = 100;
	  $following = UserFollowing::find($criteria, ['follower_user_id' => 'DESC']);
	  if ($limit)
		  $following->paginate(0, $limit);
	  $users_ids = lmbArrayHelper::getColumnValues('follower_user_id', $following);
	  if (!$users_ids)
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

	function getDaysBeginTime()
	{
		$query = new lmbSelectQuery('moment');
		$query->addRawField('day.id as day_id');
		$query->addRawField('moment.id as moment_id');
		$query->addRawField('min(moment.time) as time');
		$query->addCriteria(
			lmbSQLCriteria::equal('day.is_deleted', 0)
			->add(lmbSQLCriteria::equal('day.user_id', $this->id))
		);
		$query->addGroupBy('day_id');
		$query->addOrder('moment.time', 'ASC');
		$query->addLeftJoin('day', 'id', 'moment', 'day_id');
		return $query->fetch();
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
	  return $this->_getNewsWithLimitation($from_id, $to_id, $limit, null);
  }

	function getUnreadNewsWithLimitation($from_id = null, $to_id = null, $limit = null)
	{
		return $this->_getNewsWithLimitation($from_id, $to_id, $limit, 0);
	}

	protected function _getNewsWithLimitation($from_id, $to_id, $limit, $is_read)
	{
		$query = new lmbSelectQuery('news_recipient');
		$query->addField('news_id');
		$query->addCriteria(lmbSQLCriteria::equal('user_id', $this->id));
		if(!is_null($is_read))
			$query->addCriteria(lmbSQLCriteria::equal('is_read', $is_read));

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

	function markNewsAsRead($news_ids_or_models)
	{
		if(!count($news_ids_or_models))
			return new lmbCollection();

		if(is_object($news_ids_or_models[0]))
			$news_ids = lmbArrayHelper::getColumnValues('id', $news_ids_or_models);
		else
			$news_ids = $news_ids_or_models;

		$query = new lmbUpdateQuery('news_recipient');
		$query->addField('is_read', '1');
		$query->addCriteria(lmbSQLCriteria::in('news_id', $news_ids));
		$query->addCriteria(lmbSQLCriteria::equal('user_id', $this->id));
		$query->execute();
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

  static function findWithOldDays()
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

	static function findWithUnreadNews($notification_period)
	{
		$criteria = lmbSQLCriteria::equal('user_settings.notifications_period_fb', $notification_period)
			->add(lmbSQLCriteria::equal('news_recipient.is_read', 1));

		$query = new lmbSelectQuery('user_settings');
		$query
				->addLeftJoin('user', 'user_settings_id', 'user_settings', 'id')
				->addLeftJoin('news_recipient', 'user_id', 'user', 'id')
				->addField('user.*')
				->where($criteria);

		return User::findByQuery($query);
	}
}
