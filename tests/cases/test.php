<?php
class Foo
{
  /**
   *@example
   */
  function bar()
  {

  }

  function baz() {}

  /**
   * @param array|null $param
   * @return bool
   */
  function baziii(array $param = null)
  {
    return (bool) true;
  }
}

$r = new ReflectionClass('Foo');
$methods = $r->getMethods();
foreach($methods as $method)
{
  $is_example = (bool) (false !== strpos($method->getDocComment(), 'example'));
  echo $method->getName().' - '.($is_example ? 'example': '').PHP_EOL;
}
//var_dump($methods[0]->getDocComment());
//if()
