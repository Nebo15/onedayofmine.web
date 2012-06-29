<?php
lmb_require('src/Json.class.php');

class odApiToMarkdownWriter
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

  function addRequest($name, $url_path, $method, array $data = array(), $response)
  {
    $request = new stdClass();
    $request->name = $name;
    $request->description = '';
    $request->url = '{{host}}'.$url_path;
    $request->method = $method;
    $request->data = $data;
    $request->response = $response;
    $this->requests[] = $request;
  }

  function saveFile()
  {
    $n = PHP_EOL;
    $nn = $n.$n;
    $output = "# API examples #".$nn;
    $output .= " Version: ".date('d.m.y H:i:s').$nn;
    foreach($this->requests as $request)
    {
      $output .= '## '.$request->name.' ##'.$nn;
      $output .= $request->method.' '.$request->url.$nn;
      if(count($request->data))
      {
        $output .= 'Request: '.$n;
        $output .= '```json'.$n.Json::indent(json_encode($request->data)).$n.'```'.$nn;
      }
      else
      {
        $output .= 'Request: `empty`'.$n;
      }
      $output .= 'Response: '.$n;
      $output .= '```'.$n.Json::indent(json_encode($request->response)).$n.'```'.$nn;
    }
    file_put_contents($this->file, $output);
  }
}
