<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/controller/BaseJsonController.class.php');

class BaseJsonControllerTest extends odUnitTestCase
{
  function testPerformAction_GuestMethod()
  {
    lmbToolkit::instance()->resetUser();
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('foo');
    $controller->performAction();
    $this->assertResponseCode(200);
    $this->assertResponse('foo');
  }

  function testPerformAction_GuestMethodByUser()
  {
    lmbToolkit::instance()->setUser(new User());
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('foo');
    $controller->performAction();
    $this->assertResponseCode(200);
    $this->assertResponse('foo');
  }

  function testPerformAction_UserMethod_Unauthorized()
  {
    lmbToolkit::instance()->resetUser();
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('baz');
    $controller->performAction();
    $this->assertResponseCode(401);
  }

  function testPerformAction_UserMethod()
  {
    lmbToolkit::instance()->setUser(new User());
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('baz');
    $controller->performAction();
    $this->assertResponseCode(200);
    $this->assertResponse('baz');
  }

  function testPerformAction_UserAsDefault()
  {
    lmbToolkit::instance()->resetUser();
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('bar');
    $controller->performAction();
    $this->assertResponseCode(401);
  }

  function testPerformAction_BothMethods()
  {
    lmbToolkit::instance()->resetUser();
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('zoo');
    $controller->performAction();
    $this->assertResponseCode(200);
    $this->assertResponse('guest_zoo');

    lmbToolkit::instance()->setUser(new User());
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('zoo');
    $controller->performAction();
    $this->assertResponseCode(200);
    $this->assertResponse('user_zoo');
  }

  function testPerformAction_UnfoundedAction()
  {
    lmbToolkit::instance()->resetUser();
    $controller = new BaseJsonControllerForTest();
    $controller->setCurrentAction('wrong');
    $controller->performAction();
    $this->assertResponseCode(404);
  }

  function assertResponseCode($code)
  {
    $response_json = lmbToolkit::instance()->getResponse()->getResponseString();
    $response = json_decode($response_json);
    $this->assertEqual($code, $response->code);
  }

  function assertResponse($text)
  {
    $response_json = lmbToolkit::instance()->getResponse()->getResponseString();
    $response = json_decode($response_json);
    $this->assertEqual($text, $response->result);
  }
}

class BaseJsonControllerForTest extends BaseJsonController
{
  function doGuestFoo()
  {
    return $this->_answerOk('foo');
  }

  function doBar()
  {
    return $this->_answerOk('bar');
  }

  function doUserBaz()
  {
    return $this->_answerOk('baz');
  }

  function doUserZoo()
  {
    return $this->_answerOk('user_zoo');
  }

  function doGuestZoo()
  {
    return $this->_answerOk('guest_zoo');
  }
}

