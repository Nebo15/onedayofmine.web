<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Moment.class.php');

class MomentController extends BaseJsonController
{
  protected $_object_class_name = 'Moment';

  function doUpdate()
  {
    return $this->_answerOk(odMock::moment());
  }

  function doShare()
  {
    return $this->_answerOk();
  }

  function doComment()
  {
    return $this->_answerOk(array(odMock::momentComment(), odMock::momentComment()));
  }

  function doDelete()
  {
    return $this->_answerOk();
  }
}
