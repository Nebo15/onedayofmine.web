<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseComment extends BaseModel
{
  protected $_lazy_attributes = array('text');

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUserId();
    $export->text = $this->getText();
    $export->likes_count = $this->getLikesCount() ?: 0;
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    return $export;
  }
}
