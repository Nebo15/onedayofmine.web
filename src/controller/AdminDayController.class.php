<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/DayTest.class.php');

class AdminDayController extends lmbAdminObjectController
{
  protected $_object_class_name = 'Day';

  function doInterest()
  {
    return $this->doDisplay();
  }
}
