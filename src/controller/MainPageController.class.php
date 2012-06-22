<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MainPageController extends lmbController
{
  function doDisplay()
  {
    $this->users = lmbToolkit::instance()->getFacebook()->getTestUsers();
  }

  function doUpdate()
  {
    echo '<pre>';
    system(lmb_env_get('APP_DIR').'/bin/update.sh');
    die();
  }
}
