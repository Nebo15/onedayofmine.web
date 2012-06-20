<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MainPageController extends lmbController
{
  function doDisplay()
  {
    $this->users = lmbToolkit::instance()->getFacebook()->getTestUsers();
  }
}
