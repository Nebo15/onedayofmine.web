<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('src/odMock.class.php');
lmb_require('src/Json.class.php');

class PagesController extends lmbController
{
  function doDay()
  {
    $id = $this->request->get('id');

    $this->day = Day::findById($id);
    if(!$this->day || $this->day->getIsDeleted())
      return $this->_answerNotFound();

    $this->host_name = lmb_env_get('HOST_NAME');
    $this->fb_app_namespace = $this->toolkit->getConf('common')->fb_app_namespace;
    $this->fb_app_id = $this->toolkit->getConf('common')->fb_app_id;
  }

}
