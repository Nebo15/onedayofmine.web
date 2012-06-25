<?php
lmb_require('src/model/BaseModel.class.php');

class DayComment extends BaseModel
{
  protected $_db_table_name = 'day_comment';

  protected $_default_sort_params = array('id'=>'asc');

  protected $_lazy_attributes = array('text');

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
}
