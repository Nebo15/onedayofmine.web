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

	function getMessageWithSiteUrls()
	{
		$search = ['/odom:\/\/users\/(\d+)/', '/odom:\/\/days\/(\d+)/'];
		$replace = ['/pages/$1/user', '/pages/$1/day'];
		return preg_replace($search, $replace, $this->text);
	}
}
