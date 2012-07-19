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
  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'recipient'=> array ('field' => 'recipient_id', 'class' => 'User'),
      'user'     => array ('field' => 'user_id',      'class' => 'User'),
      'day'      => array ('field' => 'day_id',       'class' => 'Day',    'can_be_null' => true),
      'moment'   => array ('field' => 'moment_id',    'class' => 'Moment', 'can_be_null' => true),
    );
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNewForUser(User $user, $from_id = null, $to_id = null)
  {
    // We can do this with $user->getNews(CRITERIA HERE), but i dont know how slow it is in limb or even is it support this type of request
    $criteria = lmbSQLCriteria::equal('recipient_id', $user->getId());
    if(!is_null($from_id))
      $criteria->add(lmbSQLCriteria::greater('id', $from_id));
    if(!is_null($to_id))
      $criteria->add(lmbSQLCriteria::less('id', $to_id));
    return News::find(array('criteria' => $criteria));
  }
}
