<?php
lmb_require('src/Json.class.php');

class odPostmanWriter
{
  protected $collection_id;
  protected $requests = array();

  function __construct()
  {
    $this->collection_id = uniqid('collection_');
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
    $request->data = $data ? preg_replace('#(cover_content|image_content)=[^&]*#is', '$1=[img]', http_build_query($data)): '';
    $request->dataMode = 'params';
    $request->timestamp = 0;
    $request->time = time();
    $this->requests[] = $request;
  }

  function getCollectionContent($name)
  {
    $output = new stdClass();
    $output->id = $this->collection_id;
    $output->name = $name;
    $output->timestamp = time();
    $output->requests = $this->requests;
    return Json::indent(json_encode($output));
  }

  function saveFile($file)
  {
    file_put_contents($file, $this->getCollectionContent('onedayofmine - '.date('d.m.y H:i:s')));
  }
}
