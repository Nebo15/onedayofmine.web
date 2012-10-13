<?php

class odStrictPropsObject
{
  function getPropertiesNames()
  {
    return od_get_public_props_names($this);
  }

  function getTextPropsList()
  {
    return implode(", ", od_get_public_props_names($this));
  }

  function __get($name)
  {
    throw new Exception("No such property '$name' in class " . get_class($this) . " to get, available properties: " .
                        $this->getTextPropsList());
  }

  function __set($name, $value)
  {
    throw new Exception("No such property '$name' in class " . get_class($this) . " to set, available properties: " .
                        $this->getTextPropsList());
  }
}

class odDirtableObject extends odStrictPropsObject
{
  private $__dirty_props = array();

  function set($name, $value)
  {
    $old_value = $this->$name;

    //no need to update the property which has the same value
    if($value === $old_value)
      return;

    $this->$name = $value;
    $this->__dirty_props[$name] = 1;
  }

  function isDirty()
  {
    return sizeof($this->__dirty_props) > 0;
  }

  function isDirtyProp($name)
  {
    return isset($this->__dirty_props[$name]);
  }

  function getDirtyProps()
  {
    return $this->__dirty_props;
  }

  function undirty()
  {
    $this->__dirty_props = array();
  }

  protected function _markDirtyProp($name)
  {
    $this->__dirty_props[$name] = 1;
  }

  protected function _unmarkDirtyProp($name)
  {
    unset($this->__dirty_props[$name]);
  }
}

function od_q($str)
{
  return $str ? '"'.$str.'"' : $str;
}

function od_get_public_props_names($obj)
{
  static $cache = array();
  $klass = is_string($obj) ? $obj : get_class($obj);
  if(!isset($cache[$klass]))
    $cache[$klass] = array_keys(get_class_vars($klass));
  return $cache[$klass];
}

function od_get_public_props($obj)
{
  return get_object_vars($obj);
}

function od_copy_public_props($src, $dst)
{
  $props = od_get_public_props_names($src);
  foreach($props as $p)
    $dst->$p = $src->$p;
}

function od_props_arr2flat_arr(array $arr, array $order_props)
{
  $flat = array();
  foreach($order_props as $p)
    $flat[] = $arr[$p];
  return $flat;
}

function od_field_extract_value(&$arr, $name, $asis, $default = null)
{
  if($asis)
    return $arr;

  if(!is_array($arr))
    throw new Exception("Not array");

  if(!is_string($name))
    return array_shift($arr);

  if(!isset($arr[$name]))
  {
    if($default !== null)
      return $default;

    throw new Exception("No array item '$name'");
  }

  $val =  $arr[$name];
  unset($arr[$name]);
  return $val;
}

function od_field_set_value(&$arr, $name, $value)
{
  if($name)
    $arr[$name] = $value;
  else
    $arr[] = $value;
}

function od_field_get_number(&$arr, $name, $asis = false, $default = null)
{
  $item = od_field_extract_value($arr, $name, $asis, $default);

  if(!is_numeric($item))
    throw new Exception("Bad item, not a number(" . serialize($item) . ")");

  return 1*$item;
}

function od_field_get_strnumber(&$arr, $name, $asis = false, $default = null)
{
  $item = od_field_extract_value($arr, $name, $asis, $default);

  if(is_string($item))
  {
    if(strlen($item) === 0)
      throw new Exception("Bad item, string empty, crc28 can't be generated");
    $item = od_crc28($item);
  }

  if(!is_numeric($item))
    throw new Exception("Bad item, not a number(" . serialize($item) . ")");

  return 1*$item;
}

function od_field_get_string(&$arr, $name, $asis = false, $default = null)
{
  $item = od_field_extract_value($arr, $name, $asis, $default);

  //special case for empty strings
  if(is_bool($item) && $item === false)
    return '';
  if(!is_string($item))
    throw new Exception("Bad item, not a string(" . serialize($item) . ")");

  return $item;
}

function od_field_get_array(&$arr, $name, $asis = false, $default = null)
{
  $item = od_field_extract_value($arr, $name, $asis, $default);

  if(!is_array($item))
    throw new Exception("Bad item, not a array(" . serialize($item) . ")");

  return $item;
}
