<?php
lmb_require('Swagger/*.php');

class ApiDocController extends lmbController
{
  function doDisplay() {
      $this->response->setContentType('application/json');
      return $this->_createSwagger()->getResource('/api_doc');
  }

  function doUser() {
    $this->response->setContentType('application/json');
    return $this->_createSwagger()->getApi('/api_doc', '/user');
  }

  protected function _createSwagger()
  {
    return \Swagger\Swagger::discover(lmb_env_get('APP_DIR') . '/src')
      ->setBasePath('http://' . lmb_env_get('SERVER_NAME'))
      ->setVersion("1.0")
      ->setApiVersion("1.0");
  }
}
