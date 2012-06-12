<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Complaint.class.php');

class ComplaintController extends BaseJsonController
{
  protected $_object_class_name = 'Complaint';

  function doCreate()
  {
    return $this->_answerOk('Ok');
  }

  function doGet()
  {
    return $this->_answerOk('Ok');
  }
}
