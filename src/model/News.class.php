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
  protected $_default_sort_params = array('id'=>'desc');
  protected $_db_table_name = 'news';

  public $sender_id;
  public $user_id;
  public $link;
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
    $validator->addRequiredRule('text');
    return $validator;
  }

  function setSender(User $user)
  {
    $this->user_id = $user->id;
  }

  function exportForApi(array $properties = null)
  {
    $exported = parent::exportForApi(array(
      'id', 'sender_id', 'text', 'user_id', 'day_id', 'day_comment_id', 'moment_id', 'moment_comment_id', 'link',
    ));

    $exported->time = $this->getCtime();

    return $exported;
  }

  /**
   * @return lmbCollectionInterface
   */
  static function findNewsForUser(User $user, $from_id = null, $to_id = null, $limit = null)
  {
    $query = new lmbSelectQuery('news_recipient');
    $query->addField('news_id');
    $query->addCriteria(lmbSQLCriteria::equal('user_id', $user->id));

    $result = $query->fetch();
    $ids = lmbArrayHelper::getColumnValues('news_id', $result);
    if(!count($ids))
      return array();

    $criteria = lmbSQLCriteria::in('id', $ids);
    if($from_id)
      $criteria->add(lmbSQLCriteria::less('id', $from_id));
    if($to_id)
      $criteria->add(lmbSQLCriteria::greater('id', $to_id));

    $params = array(
      'sort' => array('id' => 'DESC'),
      'criteria' => $criteria,
      'limit' => (!$limit || $limit > 100) ? 100 : $limit,
    );

    return News::find($params);
  }
}
