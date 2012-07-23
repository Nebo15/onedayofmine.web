<?php
lmb_require('src/model/BaseModel.class.php');

abstract class Comment extends BaseModel {
  protected $_default_sort_params = array('id'=>'asc');
  protected $_lazy_attributes = array('text');
}
