<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/cases/odTestsTools.class.php');

class MainPageController extends lmbController
{
  function doDisplay()
  {
    $this->users = odTestsTools::loadTestUsersFromFb();
  }

  function doDeploy()
  {
    echo '<pre>';
    system(lmb_env_get('APP_DIR').'/bin/update.sh');
    die();
  }
}
