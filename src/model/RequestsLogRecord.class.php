<?php
lmb_require('src/model/base/BaseModel.class.php');
lmb_require('src/Json.class.php');

class RequestsLogRecord extends BaseModel
{
  protected $_db_table_name = 'requests_log';

  protected $_default_sort_params = array('id'=>'desc');
}
