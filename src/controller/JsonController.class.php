<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');

class JsonController extends lmbController
{
  protected $check_auth = true;

  function performAction()
  {
    if($this->is_forwarded)
      return false;

    if($this->check_auth && !$this->_isLoggedUser())
      return $this->_answerUnauthorized();

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
      return;
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
    return $this->_answer(null, 403, 'Access allowed only for registered users');
  }

  protected function _answer($message = null, $code = 200, $status = null)
  {
    $this->response->setCode($code);
    if($status)
      $this->response->setStatus($status);
    return json_encode($message);
  }
}
