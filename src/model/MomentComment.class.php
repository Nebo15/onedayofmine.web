<?php
lmb_require('src/model/Comment.class.php');

/**
 * @api
 */
class MomentComment extends Comment
{
  protected $_db_table_name = 'moment_comment';

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

  function exportForApi()
  {
    $export = parent::exportForApi();
    $export->moment_id = $this->getMoment()->getId();
    return $export;
  }
}
