<?php
lmb_require('limb/web_app/src/request/lmbRequestDispatcher.interface.php');

class RoutesRequestDispatcher implements lmbRequestDispatcher
{
  function dispatch($request)
  {
    $routes = lmbToolkit :: instance()->getRoutes();

    $uri = $request->getUri();
    $uri->normalizePath();

    if(method_exists($request, 'getRequestMethod'))
      $result = $routes->dispatch($uri, $request->getRequestMethod());
    else
      $result = $routes->dispatch($uri);

    if($action = $request->get('action'))
      $result['action'] = $action;

    if(isset($result['action']) && is_numeric($result['action']))
    {
      $tmp = array_key_exists('id', $result) ? $result['id'] : 'item';
      $result['id'] = (int) $result['action'];
      $request->set('id', (int) $result['id']);
      if($tmp) $result['action'] = $tmp;
    }

    if($controller = $request->get('controller'))
      $result['controller'] = $controller;

	  if (extension_loaded('newrelic'))
	    newrelic_name_transaction($result['controller'].":".$result['action']);

    return $result;
  }
}


