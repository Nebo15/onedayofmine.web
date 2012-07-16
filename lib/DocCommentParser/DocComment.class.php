<?php
class DocComment {
  protected $source = array();
  protected $meta = array();

  public function __construct($source) {
    $this->source = explode(' ', $source);
  }

  public function declareToken($name) {
    if(count($this->source)) {
      $this->meta[$name] = array_shift($this->source);
    } else {
      throw new Exception("There are nothing to tokenize.");
    }
  }

  public function applyFunction(Closure $function) {
    return $function($this);
  }

  public function applyPattern(AbstractCommentPattern $pattern) {
    $pattern->apply($this);
  }

  public function __set($name, $value) {
    $this->meta[$name] = $value;
  }

  public function __get($name) {
    switch ($name) {
      case 'description':
        return implode(' ', $this->source);
        break;

      default:
        if(array_key_exists($name, $this->meta)) {
          return $this->meta[$name];
        } else {
          throw new Exception("There are no token '{$name}' declared.");
        }
        break;
    }
  }

  public function __isset($name) {
    return array_key_exists($name, $this->meta);
  }

  public function __unset($name) {
    unset($this->meta[$name]);
  }
}