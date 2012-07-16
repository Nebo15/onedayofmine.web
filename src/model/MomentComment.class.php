<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @api
 */
class MomentComment extends BaseModel
{
  protected $_db_table_name = 'moment_comment';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('text');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ( 'field' => 'user_id', 'class' => 'User'),
      'moment' => array ( 'field' => 'moment_id', 'class' => 'Moment'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredObjectRule('user', 'User', 'User is required');
    $validator->addRequiredObjectRule('moment', 'Moment', 'Moment is required');
    $validator->addRequiredRule('text');
    return $validator;
  }
}
