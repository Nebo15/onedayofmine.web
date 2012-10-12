<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/model/traits/Imageable.trait.php');
lmb_require('src/model/MomentComment.class.php');
lmb_require('src/model/MomentLike.class.php');

/**
 * @api
 * @method string facebook_uid
 * @method void setFacebookUid(string $facebook_user_id)
 * @method string facebook_access_token
 * @method string getDay()
 * @method string getDayId()
 * @method string getDescription()
 * @method void setFacebookAccessToken(string $facebook_access_token)
 */
class Moment extends BaseModel
{
  use Imageable;

  public $day_id;
  public $description;
  public $time;
  public $timezone;
  public $is_deleted;

  protected $_default_sort_params = array('time' => 'ASC');
  protected $_db_table_name = 'moment';

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('day_id');
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $moment = new stdClass();
    $moment->id = $this->id;
    $moment->day_id = $this->day_id;
    $moment->description = $this->description;
    $this->showImages($moment);
    $moment->time = BaseModel::stampToIso($this->time, $this->timezone);

    if($this->is_deleted)
      $moment->is_deleted = true;

    return $moment;
  }

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
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

  protected function _getAdditionalPlaceholders(&$placeholders)
  {
    if(!$this->day_id)
      throw new Exception("Can't create image path, because entity have no corresponding User.", array('class' => get_called_class()));

    $placeholders[':day_id']  = $this->day_id;
    $placeholders[':hash']    = sha1('s0l7&p3pp$r'.$this->id.$this->day_id);
  }
}
