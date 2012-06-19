<?php
lmb_require('src/Json.class.php');

class PostmanWriter
{
  protected $file;
  protected $collection_id;
  protected $requests = array();

  function __construct($file)
  {
    $this->file = $file;
    $this->collection_id = uniqid('collection_');
  }

  function deleteFile()
  {
    if(file_exists($this->file))
      unlink($this->file);
  }

  function addRequest($name, $url_path, $method, array $data = array())
  {
    $request = new stdClass();
    $request->collectionId = $this->collection_id;
    $request->id = uniqid('request_');
    $request->name = $name;
    $request->description = '';
    $request->url = '{{host}}'.$url_path;
    $request->method = $method;
    $request->headers = '';
    $request->data = $data ? http_build_query($data) : '';
    $request->dataMode = 'params';
    $request->timestamp = 0;
    $request->time = time();
    $this->requests[] = $request;
  }

  function saveFile()
  {
    $output = new stdClass();
    $output->id = $this->collection_id;
    $output->name = 'onedayofmine - '.date('d.m.y H:i:s');
    $output->timestamp = time();
    $output->requests = $this->requests;
    file_put_contents($this->file, Json::indent(json_encode($output)));
  }
}
