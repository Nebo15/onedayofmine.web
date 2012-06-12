<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Complaint.class.php');

class ComplaintController extends BaseJsonController
{
  protected $_object_class_name = 'Complaint';

  function doCreate()
  {
    return $this->_answerOk(array('complaint_id' => 222));
  }

  function doGet()
  {
    $complaint = new Complaint();
    $complaint->setText('complaint_text1');
    $complaint->setDayId(42);
    $complaint->setMomentId(111);
    return $this->_answerOk(array($complaint->exportToSimpleObj()));
  }
}
