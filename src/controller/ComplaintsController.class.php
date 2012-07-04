<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Complaint.class.php');

class ComplaintsController extends BaseJsonController
{
  protected $_object_class_name = 'Complaint';

  function doCreate()
  {
    if(!$this->request->hasPost())
      return $this->_answerNotPost();

    if(!Day::findById($this->request->id))
      return $this->_answerWithError("Day with id '".$this->request->get('day_id')."' not found");

    return $this->_importSaveAndAnswer(new Complaint(), array('day_id', 'text'));
  }
}
