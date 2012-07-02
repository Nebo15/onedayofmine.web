<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('src/odMock.class.php');
lmb_require('src/Json.class.php');

abstract class BaseJsonController extends lmbController
{
  /**
   * @var odTools
   */
  protected $toolkit;
  protected $check_auth = true;

  function performAction()
  {
    if($this->is_forwarded)
      return false;

    if($this->check_auth && !$this->toolkit->getSessidFromRequest())
    {
      $sessid_name = lmb_env_get('SESSION_NAME');
      $this->response->write($this->_answerWithError("Where is may '$sessid_name', Lebowsky?"));
      return null;
    }

    if($this->check_auth && !$this->_isLoggedUser())
    {
      $this->response->write($this->_answerUnauthorized());
      return null;
    }

    if(method_exists($this, $method = $this->_mapCurrentActionToMethod()))
    {
      if($template_path = $this->findTemplateForAction($this->current_action))
        $this->setTemplate($template_path);

      $method_response = $this->$method();

      $this->_passLocalAttributesToView();

      if(is_string($method_response))
        $this->response->write($method_response);
      else
        throw new lmbException("Method '$method' must return a string");

      return $method_response;
    }
    elseif($template_path = $this->findTemplateForAction($this->current_action))
    {
      $this->setTemplate($template_path);
      $this->_passLocalAttributesToView();
      return null;
    }

    throw new lmbException('No method defined in controller "' .
      $this->getName(). '" for action "' . $this->current_action . '" ' .
      'and no appropriate template found');
  }

  /**
   * @return User
   */
  protected function _getUser()
  {
    return $this->toolkit->getUser();
  }

  protected function _isLoggedUser()
  {
    return (null != $this->toolkit->getUser()) ? true : false;
  }

  protected function _checkPropertiesInRequest(array $properties)
  {
    foreach($properties as $property)
    {
      if(!$this->request->get($property))
        $this->error_list->addError("Property '$property' not found in request");
    }
    return $this->error_list->export();
  }

  protected function _importSaveAndAnswer($item, array $properties)
  {
    foreach($properties as $property)
      $item->set($property, $this->request->get($property));

    $item->validate($this->error_list);
    if($this->error_list->isValid())
    {
      $item->saveSkipValidation();
      $res = $item->exportForApi();
      foreach($res as $key => $property)
        if(is_object($property))
          unset($res[$key]);
      return $this->_answerOk($res);
    }
    else
    {
      return $this->_answerWithError($this->error_list->export());
    }
  }

  protected function _answerUnauthorized()
  {
    return $this->_answerWithError('Access allowed only for registered users', null, 403);
  }

  protected function _answerOk($result = null, $status = null, $code = 200)
  {
    return $this->_answer($result, array(), $status, $code);
  }

  protected function _answerWithError($errors, $status = null, $code = 400)
  {
    if(!is_array($errors))
    {
      if(!$errors)
        throw new lmbException("Error can't be empty");
      $errors = array($errors);
    }
    else
    {
      if(!count($errors))
        throw new lmbException("Error can't be empty");
    }

    return $this->_answer(null, $errors, $status, $code);
  }

  protected function _answerNotFound($message)
  {
    return $this->_answer($message, array(), $message, 404);
  }

  protected function _answerNotPost($message = 'Not a POST request')
  {
    return $this->_answerWithError($message, null, 405);
  }

  protected function _answer($result, array $errors, $status, $code)
  {
    if($code)
      $this->response->setCode($code);
    if($status)
      $this->response->setStatus($status);

    return Json::indent(json_encode(
      array(
        'code' => $code,
        'status' => $this->response->getStatus(),
        'result' => $result,
        'errors' => $errors)
    ));
  }
}
