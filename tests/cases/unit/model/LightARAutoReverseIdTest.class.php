<?php
require_once('BaseLightARTest.class.php');

class LightARAutoReverseIdTest extends BaseLightARTest
{
  function testSetReverseIdAutomaticallyOnCreate()
  {
    $object = new TestLightARWithReverseId($this->connection);
    $object->priority = rand(1, 10000);
    $object->save();

    $this->assertEqual(lmb_env_get('MAX_ID_VALUE') - 1, $object->reverse_id);
  }
}


