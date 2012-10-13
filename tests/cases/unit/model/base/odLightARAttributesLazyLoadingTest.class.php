<?php
require_once('BaseLightARTest.class.php');

class lmbARAttributesLazyLoadingTest  extends BaseLightARTest
{
  function testFind_WithoutLazyAttributes()
  {
    $object = $this->createSampleAR();
    /** @var $object2 TestLightARWithLazyAttributes */
    $object2 = TestLightARWithLazyAttributes :: findById($object->id);
    $object3 = TestLightAR :: findById($object->id);

    $this->assertEqual($object->id, $object2->id);
    $this->assertTrue(isset($object->priority));

    $this->assertNull($object2->title);
    $this->assertNull($object2->content);

    $this->assertEqual($object3->title, $object->title);
    $this->assertEqual($object3->content, $object->content);
  }

  function testFindWithAllLazyAttributes()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $object3 = TestLightARWithLazyAttributes :: findFirst('id = '. $object2->id, null, true);
    $this->assertEqual($object3->title, $object2->title);
    $this->assertEqual($object3->content, $object2->content);

    $object4 = TestLightARWithLazyAttributes :: findById($object2->id, false, true);
    $this->assertEqual($object4->title, $object2->title);
    $this->assertEqual($object4->content, $object2->content);
  }

  function testFindWithParticularLazyAttributes()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $object3 = TestLightARWithLazyAttributes :: findFirst('id = '. $object2->id, null, array('title'));
    $this->assertEqual($object3->title, $object2->title);
    $this->assertNull($object3->content);

    $object4 = TestLightARWithLazyAttributes :: findById($object2->id, false, array('title'));
    $this->assertEqual($object4->title, $object2->title);
    $this->assertNull($object4->content);
  }

  function testForceToLoadParticularAttributes()
  {
    $object1 = $this->createSampleAR();
    $object2 = $this->createSampleAR();

    $object3 = TestLightARWithLazyAttributes :: findFirst('id = '. $object2->id, null, array('title'));
    $this->assertEqual($object3->title, $object2->title);
    $this->assertNull($object3->content);

    $object4 = TestLightARWithLazyAttributes :: findById($object2->id, false, array('title'));
    $this->assertEqual($object4->title, $object2->title);
    $this->assertNull($object4->content);
  }
}

