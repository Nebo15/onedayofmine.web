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
  }

  protected function _createValidator()
  {
    $validator = new lmbValidator();
    $validator->addRequiredRule('user');
    $validator->addRequiredObjectRule('user', 'User');
    $validator->addRequiredRule('title');
    $validator->addRequiredRule('description');
    $validator->addRequiredRule('time_offset');
    return $validator;
  }

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUserId();
    $export->title = $this->getTitle();
    $export->description = $this->getDescription();
    $export->time_offset = $this->getTimeOffset();
    $export->likes_count = $this->getLikesCount();
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    return $export;
  }
}
