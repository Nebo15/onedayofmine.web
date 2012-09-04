<?php
lmb_require('src/model/base/BaseComment.class.php');

/**
 * @api
 */
class DayFinishComment extends BaseComment
{
  protected $_default_sort_params = array('id'=>'asc');
  protected $_db_table_name = 'day_finish_comment';

  protected function _defineRelations()
  {
    $this->_belongs_to = array(
      'day' => array('field' => 'finish_comment_id', 'class' => 'Day')
    );

    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredObjectRule('user', 'User', 'User is required');
    $validator->addRequiredRule('text');
    return $validator;
  }
}
