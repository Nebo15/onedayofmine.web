<?php
lmb_require('limb/net/src/lmbIp.class.php');

class BaseModel extends lmbActiveRecord
{
  protected $_default_sort_params = array('id'=>'asc');

  function exportToSimpleObj()
  {
    return (object) $this->export();
  }

  protected function _onBeforeCreate()
  {
    $this->cip = lmbIp::encode(lmbIp::getRemoteIp());
  }

  protected function _onAfterUpdate()
  {
    $this->uip = lmbIp::encode(lmbIp::getRemoteIp());
  }
}
