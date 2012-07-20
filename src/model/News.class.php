<?php

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
  protected $_default_sort_params = array('id'=>'desc');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'recipient'=> array ('field' => 'recipient_id', 'class' => 'User'),
      'user'     => array ('field' => 'user_id',      'class' => 'User'),
      'day'      => array ('field' => 'day_id',       'class' => 'Day',    'can_be_null' => true),
      'moment'   => array ('field' => 'moment_id',    'class' => 'Moment', 'can_be_null' => true),
    );
  }

  function exportForApi()
  {
    $exported = $this->export();
    
    return (object) $exported;
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNewForUser(User $user, $from_id = null, $to_id = null, $limit = null)
  {
    $params = array();

    $criteria = lmbSQLCriteria::equal('recipient_id', $user->getId());
    if(!is_null($from_id))
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if(!is_null($to_id))
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    $params['criteria'] = $criteria;

    if(!is_null($limit))
      $params['limit'] = $limit;

    return News::find($params);
  }
}
