<?php
lmb_require('src/model/Commentable.class.php');

/**
 * @api
 */
class DayComment extends Commentable
{
  protected $_db_table_name = 'day_comment';

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User'),
      'day' =>  array ('field' => 'day_id', 'class' => 'Day'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredObjectRule('user', 'User', 'User is required');
    $validator->addRequiredObjectRule('day', 'Day', 'Day is required');
    $validator->addRequiredRule('text');
    return $validator;
  }

  function exportForApi()
  {
    $export = parent::exportForApi();
    $export->day_id = $this->getDay()->getId();
    return $export;
  }
}
