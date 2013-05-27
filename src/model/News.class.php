<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/User.class.php');

/**
 * @api field uint(11) id News ID
 * @api field uint(11) recipient_id Recipient ID - user, that shoud recieve message
 * @api field uint(11) user_id User ID - uset, that created news event
 * @api field string(255) text Text of news message
 * @api field uint(11) day_id ID of day, on wich this news is linked to.
 * @api field uint(11) moment_id ID of moment, on wich this news is linked to.
 * @api field uint(11) ctime Unix timestamp, time of news creation
 */
class News extends BaseModel
{
	/*
   * News types.
   */
	## Day ##
	const MSG_DAY_CREATED         = "day_created";
	const MSG_DAY_COMMENT         = "day_comment";
	const MSG_DAY_LIKED           = "day_liked";
	const MSG_DAY_SHARE           = "day_shared";
	const MSG_DAY_FAVORITE        = "day_favorite";
	const MSG_DAY_GATHERING       = "day_gathering";

	## Moment ##
	const MSG_MOMENT_CREATED      = "moment_created";
	const MSG_MOMENT_COMMENT      = "moment_commented";
	const MSG_MOMENT_LIKED        = "moment_liked";

	## Follow ##
	const MSG_USER_FOLLOW         = "user_followed";
	const MSG_USER_FOLLOW_YOU     = "user_followed_you";

	## User ##
	const MSG_FBFRIEND_REGISTERED = "user_fbfriend";

  protected $_default_sort_params = array('id' => 'desc');
  protected $_db_table_name = 'news';

  public $sender_id;
  public $user_id;
  public $link;
	public $type;
  public $text;
  public $day_id;
  public $moment_id;
  public $day_comment_id;
  public $moment_comment_id;
  public $day_like_id;
  public $moment_like_id;
  public $ctime;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('sender_id');
	  $validator->addRequiredRule('type');
    $validator->addRequiredRule('text');
    return $validator;
  }

  function setSender($user)
  {
    lmb_assert_type($user, 'User');
    $this->sender_id = $user->id;
  }

  function setUser($user)
  {
    lmb_assert_type($user, 'User');
    $this->user_id = $user->id;
  }

  function setMoment($moment)
  {
    lmb_assert_type($moment, 'Moment');
    $this->moment_id = $moment->id;
  }

  function setDay($day)
  {
    lmb_assert_type($day, 'Day');
    $this->day_id = $day->id;
  }

	static function getMessageByType($type)
	{
		$messages = [
			self::MSG_DAY_CREATED         => "{sender} just created day {day}",
			self::MSG_DAY_COMMENT         => "{sender} has responded you in day {day}",
			self::MSG_DAY_LIKED           => "{sender} liked day {day}",
			self::MSG_DAY_SHARE           => "{sender} share day {day}",
			self::MSG_DAY_FAVORITE        => "{sender} added the day {day} to favorites",
			self::MSG_DAY_GATHERING       => "{sender} need your help! Add moments to day {day}",

			self::MSG_MOMENT_CREATED      => "{sender} created moment in day {day}",
			self::MSG_MOMENT_COMMENT      => "{sender} has responded you in moment of day {day}",
			self::MSG_MOMENT_LIKED        => "{sender} liked moment in day {day}",

			self::MSG_USER_FOLLOW         => "{sender} started to following {user}",
			self::MSG_USER_FOLLOW_YOU     => "{sender} started to following you",
			self::MSG_FBFRIEND_REGISTERED => "Your facebook friend '{sender}' just started to use this application, follow him/her?",
		];
		if(!isset($messages[$type]))
			throw new lmbException("Unknown news type '$type'");
		return $messages[$type];
	}

	/**
	 * Returns message based on it's $type and $params.
	 *
	 * @param  string $type      One of {@see News::MSG_*} constants. Notice: type is text-string right now.
	 * @param  array  $params
	 * @return string
	 */
	public static function getMessage($type, array $params = array())
	{
		$tpl = News::getMessageByType($type);
		if(false !== strpos($tpl, '{sender}'))
		{
			if(!isset($params['sender']))
				throw new lmbException('sender not found in params');
			$tpl = str_replace('{sender}', "<a href=\"odom://users/{$params['sender']->id}\">{$params['sender']->name}</a>", $tpl);
		}
		if(false !== strpos($tpl, '{user}'))
		{
			if(!isset($params['user']))
				throw new lmbException('user not found in params');
			$tpl = str_replace('{user}', "<a href=\"odom://users/{$params['user']->id}\">{$params['user']->name}</a>", $tpl);
		}
		if(false !== strpos($tpl, '{day}'))
		{
			if(!isset($params['day']))
				throw new lmbException('day not found in params');
			$tpl = str_replace('{day}', "<a href=\"odom://days/{$params['day']->id}\">{$params['day']->title}</a>", $tpl);
		}
		return $tpl;
	}

  function getRecipients()
  {
    $news_recipients = NewsRecipient::find(lmbSQLCriteria::equal('news_id', $this->id));
    $recipients_ids = lmbArrayHelper::getColumnValues('user_id', $news_recipients);
    return User::findByIds($recipients_ids);
  }

  function exportForApi(array $properties = null)
  {
    $exported = parent::exportForApi(array(
      'id', 'sender_id', 'type', 'text', 'user_id', 'day_id', 'day_comment_id', 'moment_id', 'moment_comment_id', 'link',
    ));

    $exported->time = $this->ctime;

    return $exported;
  }

	function getLinkWithSiteUrl()
	{
		return $this->_replaceAppLinks($this->link);
	}

	function getMessageWithSiteUrls()
	{
		return $this->_replaceAppLinks($this->text);
	}

	protected function _replaceAppLinks($text)
	{
		$search = ['/odom:\/\/users\/(\d+)/', '/odom:\/\/days\/(\d+)/'];
		$replace = ['/pages/$1/user', '/pages/$1/day'];
		return preg_replace($search, $replace, $text);
	}

	static function findUnreadFor(User $user)
	{
		$query = new lmbSelectQuery('news_recipient');
		$query
				->addLeftJoin('news', 'id', 'news_recipient', 'news_id')
				->addField('news.*')
				->addCriteria(lmbSQLCriteria::equal('news_recipient.user_id', $user->id))
				->addCriteria(lmbSQLCriteria::equal('is_read', 0));

		return News::findByQuery($query);
	}

}
