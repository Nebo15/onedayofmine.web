<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');

abstract class BaseJsonController extends lmbController
{
  /**
   * @var OneDayTools
   */
  protected $toolkit;
  protected $check_auth = true;

  function performAction()
  {
    if($this->is_forwarded)
      return false;

    if($this->check_auth && !$this->request->has('sessid'))
    {
      $this->response->write($this->_answerWithError("Where is may 'sessid', Lebowsky?"));
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

  protected function _isLoggedUser()
  {
    return (null != $this->toolkit->getUser()) ? true : false;
  }

  protected function _answerUnauthorized()
  {
    return $this->_answerWithError('Access allowed only for registered users', null, 403);
  }

  protected function _answerOk($result = null, $status = null, $code = 200)
  {
    return $this->_answer($result, array(), $status, $code);
  }

  protected function _answerWithError($errors = null, $status = null, $code = 400)
  {
    if(!is_array($errors))
      $errors = array($errors);
    return $this->_answer(null, $errors, $status, $code);
  }

  protected function _answerNotFound($message)
  {
    return $this->_answer($message, array(), $message, 404);
  }

  protected function _answer($result, array $errors, $status, $code)
  {
    if($code)
      $this->response->setCode($code);
    if($status)
      $this->response->setStatus($status);

    return json_encode(
      array(
        'code' => $code,
        'status' => $this->response->getStatus(),
        'result' => $result,
        'errors' => $errors)
    );
  }
}
