<?php
lmb_require('src/model/base/BaseComment.class.php');

/**
 * @api
 */
class MomentComment extends BaseComment
{
  protected $_default_sort_params = array('id'=>'asc');
  protected $_db_table_name = 'moment_comment';

  public $moment_id;
  public $user_id;
  public $text;

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user_id');
    $validator->addRequiredRule('moment_id');
    $validator->addRequiredRule('text');
    return $validator;
  }

  function exportForApi(array $properties = null)
  {
    $export = parent::exportForApi($properties);
    $export->moment_id = $this->getMoment()->getId();
    return $export;
  }

  function setMoment($moment)
  {
    lmb_assert_type($moment, 'Moment');
    $this->moment_id = $moment->id;
  }

  function setUser($user)
  {
    lmb_assert_type($user, 'User');
    $this->user_id = $user->id;
  }
}
