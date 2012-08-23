<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');

class AdminRequestsLogController extends lmbController
{
  function doDisplay()
  {
    $this->items = RequestsLogRecord::find();
  }
}
