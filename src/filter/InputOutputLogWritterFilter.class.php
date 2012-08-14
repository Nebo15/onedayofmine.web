<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class InputOutputLogWritterFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $id = microtime(true);

    $toolkit = lmbToolkit::instance();

    $flat = array();
    lmbArrayHelper :: toFlatArray($toolkit->request->getPost(), $flat);
    $toolkit->getLog('request')->info('Request', array(
      'id' => $id,
      'type' => 'Request',
      'method' => $toolkit->request->getRequestMethod(),
      'uri'    => $toolkit->request->getUri()->toString(),
      'data'   => $flat,
    ));

    $filter_chain->next();

   $toolkit->getLog('request')->info('Request', array(
      'id' => $id,
      'type' => 'Response',
      // 'method' => $toolkit->request->getRequestMethod(),
      // 'uri'    => $toolkit->request->getUri()->toString(),
      // 'data'   => $toolkit->request->getDataString(),
      'code'   => $toolkit->response->getStatus(),
      'response' => $toolkit->response->getResponseString()
    ));
  }
}

