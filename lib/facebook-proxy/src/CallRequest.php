<?php

class CallRequest
{
  public $app_id;
  public $app_namespace;
  public $og_type;
  public $og_props;

  static function create($props)
  {
    $obj = new CallRequest();
    foreach($props as $property => $value)
      $obj->$property = $value;
    return $obj;
  }
}
