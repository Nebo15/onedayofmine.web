<?php
require_once(__DIR__.'/CallRequest.php');

class Client
{
  protected $proxy_url;
  protected $local_host;

  function __construct($proxy_url, $local_host)
  {
    $this->proxy_url = $proxy_url;
	  $host_parts = parse_url($local_host);
    $this->local_host = $host_parts['host'].(isset($host_parts['port']) ? $host_parts['port'] : '');
  }

  function copyObjectPageToProxy($path)
  {
    $params = new CallRequest();
    $params->path = $path;

    $content = file_get_contents('http://'.$this->local_host.'/'.$path);
    $proxy_host = parse_url($this->proxy_url)['host'];

    $params->content = str_replace($this->local_host, $proxy_host, $content);

    $request = new HttpRequest($this->proxy_url.'?action=create_page');
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
