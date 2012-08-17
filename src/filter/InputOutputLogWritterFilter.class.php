<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');
lmb_require('limb/net/src/lmbIp.class.php');

class InputOutputLogWritterFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $toolkit = lmbToolkit::instance();

    $flat_get = array();
    lmbArrayHelper :: toFlatArray($toolkit->request->getGet(), $flat_get);

    $flat_post = array();
    lmbArrayHelper :: toFlatArray($toolkit->request->getPost(), $flat_post);

    $flat_cookies = array();
    lmbArrayHelper :: toFlatArray($toolkit->request->getCookie(), $flat_cookies);

    $microseconds = microtime(true);

    $toolkit->getLog('request')->info('request', array(
      'microseconds' => $microseconds,
      'ip'           => lmbIp::getRealIp(),
      'type'         => 'request',
      'method'       => $toolkit->request->getRequestMethod(),
      'path'         => $toolkit->request->getUri()->getPath(),
      'get'          => $flat_get,
      'post'         => $flat_post,
      'cookies'      => $flat_cookies,
    ));

    $filter_chain->next();

    $toolkit->getLog('request')->info('request', array(
      'microseconds' => $microseconds,
      'ip'           => lmbIp::getRealIp(),
      'type'         => 'response',
      'method'       => $toolkit->request->getRequestMethod(),
      'path'         => $toolkit->request->getUri()->getPath(),
      'code'         => $toolkit->response->getStatus(),
      'response'     => $toolkit->response->getResponseString(),
    ));
  }
}

