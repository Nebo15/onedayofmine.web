<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/unit/odTestsTools.class.php');
lmb_require('src/Json.class.php');

class MainPageController extends BaseJsonController
{
  function doDeploy()
  {
    echo '<pre>';
    system(lmb_env_get('APP_DIR').'/cli/update.sh');
    die();
  }

  function doGuestNoop()
  {
    return $this->_answerOk();
  }

  function doGuestException()
  {
    throw new lmbException('Some exception', array('foo' => 1, 'bar' => 2));
  }
}
