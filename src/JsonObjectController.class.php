<?php
lmb_require('limb/cms/src/controller/lmbObjectController.class.php');

class JsonObjectController extends lmbObjectController
{
  protected function _convertResponse($method_response)
  {
    return json_encode($method_response);
  }
}
