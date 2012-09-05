<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');

/**
 * @api field int id User ID
 * @static Day findById()
 */
class Day extends BaseModel
{
  use Imageable;
  use Likeable;

  protected $_default_sort_params = array('id'=>'desc');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array(
      'user' => array( 'field' => 'user_id', 'class' => 'User'),
    );

    $this->_has_many = array(
      'moments'  => array( 'field' => 'day_id', 'class' => 'Moment'),
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
    $export->user_id = $this->getUser()->getId();
    $this->showImages($export);
    $export->title = $this->getTitle();
    $export->occupation = $this->getOccupation();
    $export->location = $this->getLocation();
    $export->final_description = $this->getFinalDescription();
    $export->type = $this->getType();
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();

    return $export;
  }

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    if(!$this->getUser() || !$this->getUser()->getId())
      throw new Exception("Can't create image path, because entity have no corresponding User.", array('class' => get_called_class()));

    $placeholders[':user_id'] = $this->getUser()->getId();
    $placeholders[':hash']    = sha1('s0l7&p3pp$r'.$this->getUser()->getId().$this->getId());
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
    $sql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'day' AND COLUMN_NAME = 'type'";
    $stmt = lmbToolkit::instance()->getDefaultDbConnection()->newStatement($sql);
    $stmt->execute(); // выполнит запрос.
    if(preg_match('/^enum\((.*)\)$/', $stmt->getOneRecord()->get('COLUMN_TYPE'), $matches) === 1) {
      return str_getcsv($matches[1], ',', "'");
    } else {
      throw new lmbException("Can't allocate day types.", array('query_result' => $stmt->getOneRecord()->get('COLUMN_TYPE'), 'preg_matches' => $matches));
    }
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
