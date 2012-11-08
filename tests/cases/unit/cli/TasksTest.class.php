<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');

class TasksTest extends odUnitTestCase
{
  function setUp()
  {
    lmb_require('lib/limb/taskman/taskman.inc.php');
    taskman_propset('PROJECT_DIR', lmb_env_get('APP_DIR').'/');
    lmb_require('src/cli/od.tasks.php');

    parent::setUp();
  }

  function testApnsPush()
  {
    $this->_setUpApns();

    $notification = $this->generator->deviceNotification();

    $apns = new ApnsMock();
    $apns->expectOnce('connect');
    $apns->expectOnce('send');
    $apns->expectOnce('close');
    $this->toolkit->setApns($apns);

    task_od_apns_push();

    $loaded_notification = DeviceNotification::findById($notification->id);
    if($this->assertNotNull($loaded_notification))
      $this->assertEqual(1, $loaded_notification->is_sended);
  }

  function testApnsPush_OldNotification()
  {
    $this->_setUpApns();

    $notification = $this->generator->deviceNotification();
    $notification->ctime = time() - 24 * 60 * 60 - 10;
    $notification->save();

    $apns = new ApnsMock();
    $apns->expectNever('send');

    $this->toolkit->setApns($apns);

    task_od_apns_push();

    $this->assertEqual(0, count(DeviceNotification::find()));
  }

  function testApnsPush_InvalidDeviceToken()
  {
    $this->_setUpApns();

    $this->generator->deviceNotification();

    $apns = new ApnsMock();
    $apns->throwOn('send', new Zend_Mobile_Push_Exception_InvalidToken(''));

    $this->toolkit->setApns($apns);

    $this->assertEqual(1, count(DeviceNotification::find()));
    $this->assertEqual(1, count(DeviceToken::find()));
    task_od_apns_push();
    $this->assertEqual(0, count(DeviceNotification::find()));
    $this->assertEqual(0, count(DeviceToken::find()));
  }

  function testApnsPush_AnySendError()
  {
    $this->_setUpApns();

    $notification = $this->generator->deviceNotification();
    $notification->save();

    $apns = new ApnsMock();
    $apns->throwOn('send', new lmbException(''));

    $this->toolkit->setApns($apns);

    task_od_apns_push();

    $this->assertEqual(1, count(DeviceNotification::find()));
  }

  protected function _setUpApns()
  {
    lmb_require('Zend/Mobile/Push/Apns.php');
    lmb_require('Zend/Mobile/Push/Message/Apns.php');
    lmb_require('Zend/Mobile/Push/Exception/InvalidToken.php');

    Mock::generate('Zend_Mobile_Push_Apns', 'ApnsMock');

    global $TASKMAN_VERBOSE;
    $TASKMAN_VERBOSE = false;
  }
}
