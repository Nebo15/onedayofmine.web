<?php
require_once(__DIR__.'/CallRequest.php');

class Client
{
  protected $proxy_url;
  protected $app_id;
  protected $app_namespace;

  function __construct($proxy_url, $app_id, $app_namespace)
  {
    $this->proxy_url = $proxy_url;
    $this->app_id = $app_id;
    $this->app_namespace = $app_namespace;
  }

  function createObjectPage($path, $og_type, array $og_props)
  {
    $params = new CallRequest();
    $params->path = $path;
    $params->app_id = $this->app_id;
    $params->app_namespace = $this->app_namespace;
    $params->og_type = $og_type;
    $params->og_props = $og_props;

    $request = new HttpRequest($this->proxy_url.'?action=create_object');
    $request->setMethod(HTTP_METH_POST);
    $request->setPostFields(array('params' => json_encode($params)));

    return $request->send()->getBody();
  }

  function clear()
  {
    $request = new HttpRequest($this->proxy_url.'?action=clear');
    $request->setMethod(HTTP_METH_POST);
    $request->send();
  }
}
