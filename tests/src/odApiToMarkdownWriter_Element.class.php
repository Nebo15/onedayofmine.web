<?php
lmb_require('src/Json.class.php');

/**
 * Element of markdowned API request.
 */
class odApiToMarkdownWriter_Element {
  /**
   * Data storage vars.
   */
  protected $name;
  protected $hashTag;
  protected $method;
  protected $uri;
  protected $description;
  protected $requestData;
  protected $requestDescription;
  protected $responseData;
  protected $responseDescription;

  /**
   * Created class that represent element of documentation (request in our case).
   *
   * @param string          $name                Name of API element.
   * @param string          $method              HTTP request method (POST, PUT, GET, DELET, etc.)
   * @param string          $uri                 URI
   * @param string          $description
   * @param array|stdClass  $requestData         Example request contents
   * @param array           $requestDescription  Request description
   * @param array|stdClass  $responseData        Example response contents
   * @param array           $responseDescription Response description
   */
  public function __construct($name, $method, $uri, $description, $requestData, array $requestDescription, $responseData, array $responseDescription) {
    $this->name                = $name;
    $this->hashTag             = md5($name.$uri);
    $this->uri                 = $uri;
    $this->method              = $method;
    $this->description         = $description;
    $this->requestData         = $requestData;
    $this->requestDescription  = $requestDescription;
    $this->responseData        = $responseData;
    $this->responseDescription = $responseDescription;
  }

  /**
   * Getter for name field, that used to build table of contents.
   *
   * @return string $this->name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Getter for hash tag field, that used to build table of contents.
   *
   * @return string $this->hashTag
   */
  public function getHashTag() {
    return $this->hashTag;
  }

  /**
   * Returns markdowned text that represents description of current request.
   *
   * @return string markdowned text
   */
  public function buildDescription() {
    $this->requestData  = $this->_stdClassToArray($this->requestData);
    $this->responseData = $this->_stdClassToArray($this->responseData);

    $this->_allocateUndescribedRequestParams();
    $this->_allocateUndescribedResponseParams(); // TODO disable allocation of responce after filling all phpdocks

    $this->_allocateDeprecatedRequestParams();
    $this->_allocateDeprecatedResponseParams();

    if(count($this->requestDescription)) {
      $requestDescriptionTableRows = '';
      foreach ($this->requestDescription as $requestDescriptionElement) {
        $requestDescriptionTableRows .= $this->_arrayToHTMLRows($requestDescriptionElement).PHP_EOL;
      }
      $requestDescriptionTable = <<<TBL
###### Params: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th width="40">Required</th>
  <th>Description</th>
</tr>
{$requestDescriptionTableRows}
</table>
TBL;
    } else {
      $requestDescriptionTable = '';
    }

    if(count($this->responseDescription)) {
      $responseDescriptionTableRows = '';
      foreach ($this->responseDescription as $responseDescriptionElement) {
        // Entities finder
        if($responseDescriptionElement['type'][0] != strtolower($responseDescriptionElement['type'][0])) {
          $entityName = $responseDescriptionElement['type'];
          if(substr($responseDescriptionElement['type'], -2) == '[]')
            $entityName = substr($responseDescriptionElement['type'], 0, -2);

          $responseDescriptionElement['type'] = "<a href='#Entity:{$entityName}'>{$responseDescriptionElement['type']}</a>";
        }
        $responseDescriptionTableRows .= $this->_arrayToHTMLRows($responseDescriptionElement).PHP_EOL;
      }
      $responseDescriptionTable = <<<TBL
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
{$responseDescriptionTableRows}
</table>
TBL;
    } else {
      $responseDescriptionTable = '';
    }

    $exampleRequestString  = count($this->requestData)  ? $this->_dataToNiceJson($this->requestData)  : '    empty';
    $exampleResponseString = count($this->responseData) ? $this->_dataToNiceJson($this->responseData) : '    empty';

    return <<<EOT
#### {$this->name} ####
<a name="{$this->hashTag}"></a>
{$this->description}

`{$this->method} {$this->uri}`

##### Request: #####
{$requestDescriptionTable}
###### Example request: ######
{$exampleRequestString}

##### Response: #####
{$responseDescriptionTable}
###### Example response: ######
{$exampleResponseString}
EOT;
  }

  protected function _dataToNiceJson($data) {
    return '    '.str_replace(PHP_EOL, PHP_EOL.'    ', Json::indent(json_encode($data))).PHP_EOL.PHP_EOL;
  }

  private function _stdClassToArray($stdClass) {
    if($stdClass instanceof stdClass)
      $stdClass = (array) $stdClass;

    if(is_array($stdClass)) {
      array_walk_recursive($stdClass, function(&$item, $key) {
        if($item instanceof stdClass) {
          $item = (array) $item;
        }
      });
    }

    return $stdClass;
  }

  protected function _allocateUndescribedRequestParams() {
    foreach ($this->requestData as $key => $value) {
      if(is_null($value))
        continue;

      // TODO find better way to do this
      $found = false;
      foreach ($this->requestDescription as $param) {
        if($param['name'] == $key) {
          $found = true;
        }
      }

      if(!$found) {
        $this->requestDescription[] = array(
          'type'        => '[type]',
          'name'        => $key,
          'required'    => false,
          'description' => '[description]'
        );
      }
    }
  }

  protected function _allocateDeprecatedRequestParams() {
    foreach ($this->requestDescription as $key => $value) {
      if(!array_key_exists($value['name'], $this->requestData)) {
        $this->requestDescription[$key]['name'] = "<s>{$this->requestDescription[$key]['name']}</s>";
      }
    }
  }

  protected function _allocateDeprecatedResponseParams() {
    if(is_array($this->responseData)) {
      foreach ($this->responseDescription as $key => $value) {
        if(!array_key_exists($value['name'], $this->responseData)) {
          $this->responseDescription[$key]['name'] = "<s>{$this->responseDescription[$key]['name']}</s>";
        }
      }
    }
  }

  protected function _allocateUndescribedResponseParams() { // FIXME
    if(is_array($this->responseData)) {
      foreach ($this->responseData as $key => $value) {
        // TODO find better way to do this
        $found = false;
        foreach ($this->responseDescription as $param) {
          if($param['name'] == $key) {
            $found = true;
          }
        }

        if(!$found) {
          $this->responseDescription[] = array(
            'type'        => '[type]',
            'name'        => $key,
            'description' => '[description]'
          );
        }
      }
    }
  }

  protected function _arrayToHTMLRows(array $array) {
    return '<tr><td>'.implode('</td><td>', $array).'</td></tr>';
  }
}