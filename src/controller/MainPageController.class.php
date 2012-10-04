<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('tests/src/toolkit/odTestsTools.class.php');
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

  function doGuestBundleFiles()
  {
    User::findById('1');
//    $files = array_values(get_included_files());
    $files = array_values($_ENV['LIMB_LAZY_CLASS_PATHS']);
    array_unshift($files, 'limb/core/common.inc.php');
    return $this->_answerOk($files);
  }
}
