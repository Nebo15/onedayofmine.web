<?php
require_once('BaseLightARTest.class.php');

class LightARAutoTimesTest extends BaseLightARTest
{
  /**
   * @return TestLightARWithTimes
   */
  protected function initSampleARWithTimes()
  {
    $object = new TestLightARWithTimes($this->connection);
    $object->priority = rand(1, 10000);
    return $object;
  }

  /**
   * @return TestLightARWithTimes
   */
  protected function createSampleARWithTimes()
  {
    $object = $this->initSampleARWithTimes();
    $object->save();
    return $object;
  }


  function testSetTimesAutomaticallyOnCreate()
  {
    $time = time();
    $object = $this->initSampleARWithTimes();

    $object->save();

    /** @var $object2 TestLightARWithTimes */
    $object2 = TestLightARWithTimes :: findById($this->connection, $object->id);
    $this->assertTrue($object2->utime >= $time);
    $this->assertTrue($object2->ctime >= $time);

    $this->assertEqual($object->ctime, $object2->ctime);
    $this->assertEqual($object->utime, $object2->utime);
  }

  function testKeepCTimeIfSetBeforeSaving()
  {
    $time = time();
    $object = $this->initSampleARWithTimes();
    $object->ctime = $ctime = $time - 100;

    $id = $object->save();

    /** @var $object2 TestLightARWithTimes */
    $object2 = TestLightARWithTimes :: findById($this->connection, $object->id);
    $this->assertTrue($object2->utime >= $time);
    $this->assertTrue($object2->ctime == $ctime);
  }

  function testSetTimesAutomaticallyOnUpdate()
  {
    $time = time();
    $object = $this->createSampleARWithTimes();

    $ctime1 =  $object->ctime;
    $utime1 =  $object->utime;

    sleep(1);

    $object->set('priority', $object->priority + 1);//without this object is considered to be not dirty
    $object->save();

    $ctime2 =  $object->ctime;
    $utime2 =  $object->utime;

    $this->assertTrue($ctime1 == $ctime2);
    $this->assertTrue($utime2 > $utime1);
  }
}

