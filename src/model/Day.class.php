<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');
lmb_require('src/model/Moment.class.php');
lmb_require('src/model/User.class.php');
lmb_require('src/model/DayComment.class.php');
lmb_require('src/model/MomentComment.class.php');
lmb_require('src/model/DayLike.class.php');

/**
 * @api field int id User ID
 * @static Day findById()
 */
class Day extends BaseModel
{
  use Imageable;

  protected $_default_sort_params = array('id'=>'desc');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array(
      'user' => array( 'field' => 'user_id', 'class' => 'User'),
    );

    $this->_has_many = array(
      'moments'  => array( 'field' => 'day_id', 'class' => 'Moment', 'criteria' => '`moment`.`is_deleted` = 0'),
      'comments' => array( 'field' => 'day_id', 'class' => 'DayComment'),
      'likes'    => array( 'field' => 'day_id', 'class' => 'DayLike'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user');
    $validator->addRequiredObjectRule('user', 'User');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('type');
    $validator->addRule(new lmbValidValueRule('type', self::getTypes()));
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->user_id;
    $export->type = $this->getType();
    $export->title = $this->getTitle();
    $this->showImages($export);
    $export->final_description = $this->getFinalDescription();
    $export->views_count = $this->views_count ?: 0;

    return $export;
  }

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    $placeholders[':hash'] = sha1('s0l7&p3pp$r'.$this->id);
  }

  function getCommentsWithLimitation($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = new lmbSQLCriteria();
    if($from_id)
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    if(!$limit || $limit > 100)
      $limit = 100;
    return $this->getComments()->find(array(
      'criteria' => $criteria,
      'sort' => array('id' => 'ASC')
    ))->paginate(0, $limit);
  }

  static function getTypes()
  {
    return ['Working day', 'Day off', 'Holiday', 'Trip'];
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findByUsersIds(array $ids, $from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::in('user_id', $ids);
    $criteria->add('is_deleted = 0');
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC'),
    ));
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNew($from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('is_deleted', 0);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC')
    ));
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $ids  = lmbToolkit::instance()->getSearchService('days')->find($query, $from_id, $to_id, $limit);
    $days = self::findByIds($ids);
    $days = self::sortByIds($days, $ids);
    return $days;
  }
}
