<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class InputOutputLogWritterFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $id = microtime();

    $toolkit = lmbToolkit::instance();

    $toolkit->getLog('request')->info('Request', array(
      'id' => $id,
      'method' => $toolkit->request->getRequestMethod(),
      'uri'    => $toolkit->request->getUri()->toString(),
      'data'   => $toolkit->request->getDataString(),
    ));

    $filter_chain->next();

    lmbToolkit::instance()->getLog('request')->info('Request', array(
      'id' => $id,
      'method' => $toolkit->request->getRequestMethod(),
      'uri'    => $toolkit->request->getUri()->toString(),
      'data'   => $toolkit->request->getDataString(),
      'code'   => $toolkit->response->getStatus(),
      'response' => $toolkit->response->getResponseString()
    ));
  }
}

