<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
//lmb_require('src/odMock.class.php');
lmb_require('src/Json.class.php');

class PagesController extends lmbController
{
  function doDay()
  {
    $id = $this->request->get('id');

    $this->day = Day::findById($id);
    if(!$this->day || $this->day->getIsDeleted())
      return $this->forward('pages', 'not_found');
  }

  function doMoment()
  {
    $id = $this->request->get('id');

    $this->moment = Moment::findById($id);
    if(!$this->moment || $this->moment->getDay()->getIsDeleted())
      return $this->forward('pages', 'not_found');
  }

  function doNotFound()
  {
    $this->response->setCode(404);
  }

}
