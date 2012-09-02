<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseComment extends BaseModel
{
  protected $_lazy_attributes = array('text');

  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->getId();
    $export->text = $this->getText();
    return $export;
  }
}
