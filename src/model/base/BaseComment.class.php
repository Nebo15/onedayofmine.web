<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseComment extends BaseModel {
  protected $_lazy_attributes = array('text');

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUserId();
    $export->text = $this->getText();
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    return $export;
  }
}
