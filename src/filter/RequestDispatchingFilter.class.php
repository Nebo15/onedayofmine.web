<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/web_app/src/filter/lmbRequestDispatchingFilter.class.php');
lmb_require('limb/web_app/src/request/lmbRequestDispatcher.interface.php');

class RequestDispatchingFilter extends lmbRequestDispatchingFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $dispatched_params = $this->dispatcher->dispatch($this->toolkit->getRequest());

    $this->_putOtherParamsToRequest($dispatched_params);

    if(preg_match('#^[0-9]*$#', $dispatched_params['action'])) {
      $dispatched_params['id'] = (int) $dispatched_params['action'];
      $this->toolkit->getRequest()->set('id', (int) $dispatched_params['id']);
      $dispatched_params['action'] = 'item';
    }

    $controller = $this->_createController($dispatched_params);

    if(isset($dispatched_params['action']) && $controller->actionExists($dispatched_params['action']))
      $controller->setCurrentAction($dispatched_params['action']);
    elseif(!isset($dispatched_params['action']))
      $controller->setCurrentAction($controller->getDefaultAction());
    else
      $controller = $this->_createDefaultController();

    $this->toolkit->setDispatchedController($controller);

    $filter_chain->next();
  }
}


