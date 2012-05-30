<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');

class JsonController extends lmbController
{
  protected function _convertResponse($method_response)
  {
    $this->_answerOk($method_response);
    return null; //a special for to "smart" IDE's
  }

  protected function _answerOk($data)
  {
    $this->_answer(200, $data);
    return null; //a special for to "smart" IDE's
  }

  protected function _answerWithError($data)
  {
    if(!is_array($data))
      $data = array($data);
    $this->_answer(500, $data);
    return null; //a special for to "smart" IDE's
  }

  protected function _answer($http_code, $data)
  {
    $this->response->setStatus($http_code);
    $this->response->write(json_encode($data));
    $this->response->commit();
    return null; //a special for to "smart" IDE's
  }
}
