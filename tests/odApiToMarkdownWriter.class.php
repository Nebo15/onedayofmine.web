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
    $output = "# API examples #".PHP_EOL;
    $output .= " Version: ".date('d.m.y H:i:s').PHP_EOL;
    foreach($this->requests as $request)
    {
      $output .= PHP_EOL;
      $output .= '## '.$request->name.' ##'.PHP_EOL;
      $output .= 'Url: '.$request->url.PHP_EOL;
      $output .= 'Method: '.$request->method.PHP_EOL;
      if(count($request->data))
      {
        $output .= 'Request: '.PHP_EOL;
        $output .= '```'.Json::indent(json_encode($request->data)).PHP_EOL.'```'.PHP_EOL;
      }
      else
      {
        $output .= 'Request: empty'.PHP_EOL;
      }
      $output .= 'Response: '.PHP_EOL;
      $output .= '```'.Json::indent(json_encode($request->response)).PHP_EOL.'```'.PHP_EOL;
      $output .= PHP_EOL;
    }
    file_put_contents($this->file, $output);
  }
}
