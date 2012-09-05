<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseLike extends BaseModel
{
  protected $_default_sort_params = array('ctime'=>'asc');

  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User'),
    );
  }

  function exportForApi(array $properties = null)
  {
    $exported = $this->export($properties);
    unset($exported['ctime']);
    return (object) $exported;
  }
}
