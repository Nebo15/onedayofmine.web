<?php
lmb_require('src/controller/BaseJsonController.class.php');

class NotFoundController extends BaseJsonController
{
  function doGuestDisplay()
  {
    return $this->_answerNotFound('Method not found');
  }
}
