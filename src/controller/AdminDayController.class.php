<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/Day.class.php');

class AdminDayController extends lmbAdminObjectController
{
  protected $_object_class_name = 'Day';

  protected function _onBeforeValidate()
  {
    parent :: _onBeforeValidate();$this->_validateAndSetDateFormatted($this->item, 'start_time');
  }
}