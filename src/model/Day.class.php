<?php
lmb_require('src/model/BaseModel.class.php');

/**
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
    $validator->addRequiredRule('time_offset');
    $validator->addRequiredRule('occupation');
    $validator->addRequiredRule('age');
    $validator->addRequiredRule('type');
    return $validator;
  }

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUserId();
    $export->title = $this->getTitle();
    $export->description = $this->getDescription();
    $export->time_offset = $this->getTimeOffset();
    $export->occupation = $this->getOccupation();
    $export->age = $this->getAge();
    $export->type = $this->getType();
    $export->likes_count = $this->getLikesCount();
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    $export->is_ended = $this->getIsEnded();
    return $export;
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
			$criteria->add(lmbSQLCriteria::greater('id', $to_id));
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
			$criteria->add(lmbSQLCriteria::greater('id', $to_id));
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
}
