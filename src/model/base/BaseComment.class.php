<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseComment extends BaseModel
{
  function exportForApi(array $properties = null)
  {
    $export = new stdClass();
    $export->id = $this->id;
    $export->text = $this->text;
    return $export;
  }
}
