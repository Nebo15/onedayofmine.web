<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @api field int id User ID
 * @static Day findById()
 */
class Day extends BaseModel
{
  protected $_lazy_attributes = array('description');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array(
      'user' => array( 'field' => 'user_id', 'class' => 'User'),
    );

    $this->_has_many = array(
      'moments' => array( 'field' => 'day_id', 'class' => 'Moment'),
      'comments' => array( 'field' => 'day_id', 'class' => 'DayComment'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user');
    $validator->addRequiredObjectRule('user', 'User');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('description');
    $validator->addRequiredRule('timezone');
    $validator->addRequiredRule('location');
    $validator->addRequiredRule('type');
    return $validator;
  }

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUser()->getId();
    $export->user_name = $this->getUser()->getName();
    $export->title = $this->getTitle();
    $export->description = $this->getDescription();
    $export->timezone = $this->getTimezone();
    $export->location = $this->getLocation();
    $export->type = $this->getType();
    $export->likes_count = $this->getLikesCount() ?: 0;
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    $export->is_ended = $this->getIsEnded() ?: 0;

    $comments = $this->getComments();
    $export->comments_count = $comments->count();
    $export->comments = array();
    $comments->paginate(0, lmbToolkit::instance()->getConf('common')->default_comments_count);
    foreach ($comments as $comment) {
      $export->comments[] = $comment->exportForApi();
    }

    return $export;
  }

  static function getTypes()
  {
    return array(
      'working',
      'day-off',
      'holiday',
      'trip',
      'special_event'
    );
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findByUsersIds(array $ids, $from_id = null, $to_id = null)
  {
		$criteria = lmbSQLCriteria::in('user_id', $ids);
		$criteria->add('is_deleted = 0');
		if($from_id)
			$criteria->add(lmbSQLCriteria::greater('id', $from_id));
		if($to_id)
			$criteria->add(lmbSQLCriteria::less('id', $to_id));
		return Day::find(array('criteria' => $criteria));
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNew($from_id = null, $to_id = null)
  {
		$criteria = lmbSQLCriteria::equal('is_deleted', 0);
		if($from_id)
			$criteria->add(lmbSQLCriteria::greater('id', $from_id));
		if($to_id)
			$criteria->add(lmbSQLCriteria::less('id', $to_id));
		return Day::find(array('criteria' => $criteria));
  }

  static function findUnfinished(User $user)
  {
  	$criteria = lmbSQLCriteria::equal('is_deleted', 0);
  	$criteria->add(lmbSQLCriteria::equal('is_ended', 0));
  	$days = $user->getDays()->find(array('criteria' => $criteria));
  	if(count($days) > 1)
  		throw new lmbException("User {$user->getId()} has more than one open day");
  	return $days->at(0);
  }

  static function findInteresting($from_id = null, $to_id = null)
  {
    $criteria = lmbSQLCriteria::equal('is_deleted', 0);
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    $query = lmbARQuery::create('Day');
    $query->addCriteria($criteria);
    $seconds_in_day = 86400;
    $current_time = time();
    $query->addRawOrder("(($current_time-`ctime`)/$seconds_in_day)/`likes_count` ASC");
    return $query->fetch();
  }
}
