<?php
lmb_require('src/controller/WebAppController.class.php');

class NotFoundController extends WebAppController
{
  function doDisplay()
  {
    return $this->forwardTo404();
  }
}
