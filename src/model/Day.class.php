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

    $this->_has_many = array(
      'moments' => array( 'field' => 'day_id', 'class' => 'Moment'),
    );

    $this->_has_one = array(
      'top_moment' => array('field' => 'top_moment_id', 'class' => 'Moment', 'can_be_null' => true)
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
