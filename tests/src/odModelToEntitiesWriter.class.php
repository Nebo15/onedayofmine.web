<?php
lmb_require('lib/DocCommentParser/Patterns/AbstractComment.pattern.php');
lmb_require('lib/DocCommentParser/Patterns/APIEntityComment.pattern.php');

class odModelToEntitiesWriter {
  protected $entities;
  protected $filename;

  public function __construct($filename) {
    $this->filename = $filename;
  }

  public function saveFile() {
    $this->_findEntities();

    $descriptions = '';
    foreach ($this->entities as $name => $fields) {
      $descriptions .= $this->_getEntityDescription($name, $fields) . PHP_EOL;
    }

    $contents = <<<EOT
# Entities #
$descriptions

EOT;

    file_put_contents($this->filename, $contents);
  }

  private function _getEntityDescription($name, $fields) {

    $fieldsTableRows = '';
    foreach ($fields as $field) {
      $fieldsTableRows .= $this->_arrayToHTMLRows($field);
    }

    $fieldsTable = <<<TBL
###### Fields: ######
<table width="100%" border="1">
<tr>
  <th width="40">Type</th>
  <th width="150">Name</th>
  <th>Description</th>
</tr>
{$fieldsTableRows}
</table>

TBL;

    return <<<EOT
### {$name} ###
<a name="Entity:{$name}"></a>
$fieldsTable
* * *
EOT;
  }

  protected function _arrayToHTMLRows(array $array) {
    return '<tr><td>'.implode('</td><td>', $array).'</td></tr>';
  }

  private function _findEntities() {
    $entity_files = lmb_glob(lmb_env_get('APP_DIR').'/src/model/*.class.php');
    $entities = array();
    foreach ($entity_files as $path) {
      $fileNameParts = explode('.', basename($path));
      $className = $fileNameParts[0]; // PHP 5.3 workaround of foo()[0]
      $reflection = new ReflectionClass($className);
      $doc_comment = DocCommentParser::tokenize($reflection->getDocComment());
      if($doc_comment->hasGroup('api')) {
        $doc_comment->applyPattern(new APIEntityCommentPattern());

        $declaredEntities = $doc_comment->getFilteredGroup('api', function(DocComment $comment) {
          return $comment->category == 'field';
        });

        $this->entities[$className] = array();

        foreach ($declaredEntities as $entity) {
          $this->entities[$className][$entity->name] = array(
            'type' => $entity->type,
            'name' => $entity->name,
            'description' => $entity->description
          );
        }

        // alloc undescribed rows
        $class = new $className;
        $columns = $class->getDbTable()->getColumnNames();
        foreach ($columns as $column) {
          if(!array_key_exists($column, $this->entities[$className])) {
            $this->entities[$className][$column] = array(
              'type' => '[type]',
              'name' => $column,
              'description' => '[description]'
            );
          }
        }
      }
    }
  }
}