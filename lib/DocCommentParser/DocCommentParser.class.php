<?php
class DocCommentParser {
  protected $entities = array();

  public static function tokenize($doc_comment) {
    preg_match_all('#@([a-zA-Z0-9_]+)(.*)?#i', $doc_comment, $out);

    $parser = new DocCommentParser();
    foreach ($out[1] as $key => $name) {
      $parser->addEntity($name, trim($out[2][$key]));
    }

    return $parser;
  }

  private function __construct() {}

  private function addEntity($name, $data) {
    $this->entities[$name][] = new DocComment($data);
  }

  public function getEntities() {
    return $this->entities;
  }

  public function hasGroup($name) {
    return array_key_exists($name, $this->getEntities());
  }

  public function getGroup($name) {
    if($this->hasGroup($name)) {
      return $this->getEntities()[$name]; // PHP 5.4
    } else {
      throw new Exception("Entity group '{$name}' not found.");
    }
  }

  public function getGroupEntity($name, $id = 0) {
    return $this->getGroup($name)[$id];
  }

  public function getGroupCount($name) {
    return count($this->getGroup($name));
  }

  public function getFilteredGroup($name, Closure $filter_function) {
    $result = $this->getGroup($name);
    foreach ($result as $key => $entity) {
      if(!$entity->applyFunction($filter_function)) {
        unset($result[$key]);
      }
    }
    return $result;
  }

  public function applyPattern(AbstractCommentPattern $pattern) {
    $entities = $this->getEntities();
    foreach ($entities as $key => $value) {
      $entities_group_count = $this->getGroupCount($key);
      for ($i=0; $i < $entities_group_count; $i++) {
        $value[$i]->applyPattern($pattern);
      }
    }
  }
}