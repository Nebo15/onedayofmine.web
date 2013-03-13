<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
lmb_require('src/Json.class.php');

class MainPageController extends lmbController
{
	function doDeploy()
  {
    echo '<pre>';
    system(lmb_env_get('APP_DIR').'/cli/update.sh');
    die();
  }

  function doNoop()
  {
    return $this->_answerOk();
  }
}
