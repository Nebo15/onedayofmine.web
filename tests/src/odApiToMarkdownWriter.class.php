<?php
lmb_require('src/Json.class.php');
lmb_require('tests/src/odApiToMarkdownWriter_Element.class.php');

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

  function addRequest($name, $method, $uri, $requestData, $responseData, array $docBlockEntities)
  {
    // Returns associative array based on dockblock description, assumes there are always type and name params.
    $paramParser = function($description, $required = true) 
    {
      $tokens = explode(' ', $description);

      if(count($tokens) < 2)
        throw new lmbException("You need to descripte both type and name in dock block for method {$call_name}.");

      $result = array(
        'type'        => array_shift($tokens),
        'name'        => array_shift($tokens)
      );

      if(!is_null($required))
        $result['required'] = $required;

      $result['description'] = implode(' ', $tokens);

      return $result;
    };

    $description = array_key_exists('description', $docBlockEntities) ? $docBlockEntities['description'] : null;

    $requestDescription = array();
    if(array_key_exists('option', $docBlockEntities)) {
      foreach ($docBlockEntities['option'] as $option) {
        $requestDescription[] = $paramParser($option, false);
      }
    }
    if(array_key_exists('param', $docBlockEntities)) {
      foreach ($docBlockEntities['param'] as $param) {
        $requestDescription[] = $paramParser($param, true);
      }
    }

    $responseDescription = array();
    if(array_key_exists('result-param', $docBlockEntities)) {
      foreach ($docBlockEntities['result-param'] as $param) {
        $responseDescription[] = $paramParser($param, null);
      }
    }

    list($group, $name) = explode(' - ', $name);

    $this->requests[$group][] = new odApiToMarkdownWriter_Element($name, $method, $uri, $description, $requestData, $requestDescription, $responseData, $responseDescription);
  }

  function saveFile()
  {
    $output = "# API #".PHP_EOL;
    $output .= " Version: ".date('d.m.y H:i:s').PHP_EOL.PHP_EOL;
    $output .= "## Table of contents: ##".PHP_EOL;
    $output .= "<a name='toc'></a>".PHP_EOL;

    $methodsOutput = '';
    foreach ($this->requests as $group => $value) {
      $output .= PHP_EOL."### <a href='#{$group}'>{$group}</a> ###".PHP_EOL;
      $methodsOutput .= PHP_EOL."### {$group} ###".PHP_EOL;
      $methodsOutput .= "<a name='{$group}'></a>".PHP_EOL;
      foreach ($value as $request) {
        $output .= "1. <a href='#".$request->getHashTag()."'>".$request->getName()."</a>".PHP_EOL;
        $methodsOutput .= $request->buildDescription();
        $methodsOutput .= PHP_EOL.'<a href="#toc">^ back to Table of conetens</a>'.PHP_EOL.PHP_EOL;
        $methodsOutput .= '* * *'.PHP_EOL;
      }
    }

    $output .= PHP_EOL.PHP_EOL."## API methods ##".PHP_EOL;
    $output .= $methodsOutput;

    file_put_contents($this->file, $output);
  }
}
