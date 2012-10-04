<?php
lmb_require('src/model/base/BaseComment.class.php');

/**
 * @api
 */
class DayComment extends BaseModel
{
  protected $_default_sort_params = array('id'=>'asc');
  protected $_db_table_name = 'day_comment';

  public $day_id;
  public $user_id;
  public $text;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user_id');
    $validator->addRequiredRule('day_id');
    $validator->addRequiredRule('text');
    return $validator;
  }

  function setDay(Day $day)
  {
    $this->day_id = $day->id;
  }

  function setUser($user)
  {
    $this->user_id = $user->id;
  }

  function exportForApi(array $properties = null)
  {
    return parent::exportForApi($properties);
  }
}
