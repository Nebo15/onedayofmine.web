<?php
lmb_require('src/model/base/BaseModel.class.php');

class BaseLike extends BaseModel
{
  protected function _defineRelations()
  {
    $this->_many_belongs_to = array (
      'user' => array ('field' => 'user_id', 'class' => 'User'),
    );
  }

  function exportForApi(array $properties = null)
  {
    $exported = $this->export($properties);
    unset($exported['cip']);
    unset($exported['ctime']);
    return (object) $exported;
  }
}
