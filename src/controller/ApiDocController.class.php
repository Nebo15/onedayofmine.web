<?php
lmb_require('Swagger/*.php');

class ApiDocController extends lmbController
{
    function doDisplay() {
        $this->response->setContentType('application/json');
        $swagger = \Swagger\Swagger::discover(lmb_env_get('APP_DIR') . '/src');
        return $swagger->getResource('http://' . lmb_env_get('SERVER_NAME') . '/api_doc');
    }

    function doUser() {
      $this->response->setContentType('application/json');
      $swagger = \Swagger\Swagger::discover(lmb_env_get('APP_DIR') . '/src');
      return $swagger->getApi('http://' . lmb_env_get('SERVER_NAME') . '/api_doc', '/user');
    }
}
