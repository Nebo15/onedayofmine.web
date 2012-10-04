<?php
lmb_require('src/model/odLightAR.class.php');
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');
lmb_require('src/model/Moment.class.php');
lmb_require('src/model/DayComment.class.php');
lmb_require('src/model/MomentComment.class.php');
lmb_require('src/model/DayLike.class.php');

/**
 * @api field int id User ID
 * @static Day findById()
 */
class Day extends odLightAR
{
  use Imageable;

  protected $_db_table_name = 'day';
  protected $_default_sort_params = array('id'=>'desc');

  /**
   * @var User
   */
  protected $user;
  public $user_id;
  public $type;
  public $title;
  public $final_description;
  public $views_count;
  public $is_deleted;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user_id');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('type');
    $validator->addRule(new lmbValidValueRule('type', self::getTypes()));
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->id;
    $export->user_id = $this->user_id;
    $export->type = $this->type;
    $export->title = $this->title;
    $this->showImages($export);
    $export->final_description = $this->final_description;
    $export->views_count = $this->views_count ?: 0;

    return $export;
  }

  function setUser(User $user)
  {
    $this->user_id = $user->id;
  }

  function getMoments()
  {
    return Moment::find(lmbSQLCriteria::equal('day_id', $this->id));
  }

  function getComments()
  {
    return DayComment::find(lmbSQLCriteria::equal('day_id', $this->id));
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

//    return Day::find(
//      lmbToolkit::instance()->getDefaultDbConnection(),
//      $criteria,
//      array('id' => 'DESC')
//    )->paginate(0, (!$limit || $limit > 100) ? 100 : $limit);

    return Day::find([
      'criteria' => $criteria,
      'sort' => array('id' => 'DESC')]
    )->paginate(0, (!$limit || $limit > 100) ? 100 : $limit);
  }

  static function findByString($query, $from_id = null, $to_id = null, $limit = null)
  {
    $criteria = lmbSQLCriteria::equal('is_deleted', 0);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));
    $criteria->add(lmbSQLCriteria::like('title', '%'.$query.'%'));

    return Day::find(array(
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
      'sort' => array('id' => 'DESC')
    ));
  }
}
