<?php
lmb_require('src/model/BaseModel.class.php');

class Day extends BaseModel
{
  protected $_lazy_attributes = array('description');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array(
      'user' => array( 'field' => 'user_id', 'class' => 'User'),
    );
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('description');
    return $validator;
  }
}
