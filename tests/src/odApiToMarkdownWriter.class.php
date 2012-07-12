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

  function addRequest($name, $url_path, $method, $description = null, array $requestData = array(), array $requestDescription = array(), $responseData, array $responseDescription = array())
  {
    $request = new stdClass();
    $request->name = $name;
    $request->url = $url_path;
    $request->method = $method;
    $request->description = $description;
    $request->requestData = $requestData;
    $request->requestDescription = $requestDescription;
    $request->responseData = $responseData;
    $request->responseDescription = $responseDescription;

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
      $output .= $request->description.$nn;
      $output .= '`'.$request->method.' '.$request->url.'`'.$nn;
      $output .= '### Request: ###'.$nn;

      // REQUEST
      if(count($request->requestData))
      {
        $data = Json::indent(json_encode($request->requestData));
        $output .= '    '.str_replace($n, $n.'    ', $data).$nn;

        foreach ($request->requestData as $key => $value) {
          // TODO find better way to do this
          $found = false;
          foreach ($request->requestDescription as $param) {
            if($param['name'] == $key) {
              $found = true;
            }
          }

          if(!$found) {
            $request->requestDescription[] = array(
              'required'    => true,
              'type'        => 'String',
              'name'        => $key,
              'description' => 'Describe me!'
            );
          }
        }

        if(count($request->requestDescription) > 0) {
          $output .= 'Request params: '.$nn;
          $output .= '<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th width="40">Required</th><th>Description</th></tr>'.$nn;

          foreach ($request->requestDescription as $param) {
            $param['required'] = $param['required'] ? 'Y' : 'N';
            $output .= "<tr><td>{$param['name']}</td><td>{$param['type']}</td><td>{$param['required']}</td><td>{$param['description']}</td></tr>";
          }
          $output .= '</table>'.$nn;
        }
      }
      else
      {
        $output .= '`empty`'.$nn;
      }

      // RESPONCE
      $output .= '### Response: ###'.$nn;
      if(count($request->responseData)) {
        $data = Json::indent(json_encode($request->responseData));
        $output .= '    '.str_replace($n, $n.'    ', $data).$nn;

        /*if(is_array($request->responseData)) {
          array_walk_recursive($request->responseData, function(&$item, $key) {
            if($item instanceof stdClass) {
              $item = (array) $item;
            }
          });

          foreach ($request->responseData as $key => $value) {
            // TODO find better way to do this
            $found = false;
            foreach ($request->responseDescription as $param) {
              if($param['name'] == $key) {
                $found = true;
              }
            }

            if(!$found) {
              $request->responseDescription[] = array(
                'required'    => false,
                'type'        => 'String',
                'name'        => $key,
                'description' => 'Describe me!'
              );
            }
          }
        }*/

        // var_dump((array) $request->responseData);

        if(count($request->responseDescription) > 0) {
          $output .= 'Response params: '.$nn;
          $output .= '<table width="100%" border="1"><tr><th width="150">Name</th><th width="40">Type</th><th>Description</th></tr>'.$nn;

          foreach ($request->responseDescription as $param) {
            $output .= "<tr><td>{$param['name']}</td><td>{$param['type']}</td><td>{$param['description']}</td></tr>";
          }
          $output .= '</table>'.$nn;
        }
      }
      else
      {
        $output .= '`empty`'.$nn;
      }
    }
    file_put_contents($this->file, $output);
  }
}
