<?php
lmb_require('src/Json.class.php');
lmb_require('tests/src/odApiToMarkdownWriter_Element.class.php');
lmb_require('lib/DocCommentParser/Patterns/AbstractComment.pattern.php');
lmb_require('lib/DocCommentParser/Patterns/APIComment.pattern.php');

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

  function addRequest($name, $method, $uri, $requestData, $responseData, DocCommentParser $docCommentEntities)
  {
    // Apply pattern
    $docCommentEntities->applyPattern(new APICommentPattern());

    // Find description
    $tmp = $docCommentEntities->getFilteredGroup('api', function(DocComment $comment) {
      return $comment->category == 'description';
    });
    $description = count($tmp) ? $tmp[0]->description : null;

    $requestDescription = array();
    $requestDescriptionComments = $docCommentEntities->getFilteredGroup('api', function(DocComment $comment) {
      return $comment->category == 'input';
    });
    foreach($requestDescriptionComments as $comment) {
      $requestDescription[] = array(
        'type' => $comment->type,
        'name' => $comment->name,
        'required' => $comment->required,
        'description' => $comment->description
      );
    }

    $responseDescription = array();
    $responseDescriptionComments = $docCommentEntities->getFilteredGroup('api', function(DocComment $comment) {
      return $comment->category == 'result';
    });
    foreach($responseDescriptionComments as $comment) {
      $responseDescription[] = array(
        'type' => $comment->type,
        'name' => $comment->name,
        'description' => $comment->description
      );
    }

    list($group, $name) = explode(' - ', $name);

    // Notice: it ignores all api examples, except last one
    $this->requests[$group][$name] = new odApiToMarkdownWriter_Element($name, $method, $uri, $description, $requestData, $requestDescription, $responseData, $responseDescription);
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
