<?php
lmb_require('src/model/BaseModel.class.php');

abstract class Comment extends BaseModel {
  protected $_default_sort_params = array('id'=>'asc');
  protected $_lazy_attributes = array('text');

  function exportForApi()
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->user_id = $this->getUserId();
    // $export->user_name = $this->getUser()->getName();
    $export->text = $this->getText();
    $export->likes_count = $this->getLikesCount() ?: 0;
    $export->ctime = $this->getCreateTime();
    $export->utime = $this->getUpdateTime();
    return $export;
  }
}
