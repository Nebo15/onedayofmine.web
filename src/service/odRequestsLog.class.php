<?php
lmb_require('src/model/RequestsLogRecord.class.php');

class odRequestsLog
{
  protected $time;
  protected $record;

  function addRequestRecord(lmbHttpRequest $request)
  {
    $this->time = microtime(true);

    $cookies = $request->getCookie();
    if(isset($cookies['LimbCMS']))
      unset($cookies['LimbCMS']);

    $this->record = new RequestsLogRecord(array(
      'ip'           => lmbIp::getRealIp(),
      'type'         => 'request',
      'method'       => $request->getRequestMethod(),
      'path'         => $request->getUri()->getPath(),
      'get'          => count($request->getGet()) ? serialize(lmbArrayHelper :: convertToFlatArray($request->getGet())) : '',
      'post'         => count($request->getPost()) ? serialize(lmbArrayHelper :: convertToFlatArray($request->getPost())) : '',
      'cookies'      => count($cookies) ? serialize(lmbArrayHelper :: convertToFlatArray($cookies)) : '',
    ));

    $this->record->save();
  }

  function addResponseRecord(lmbHttpResponse $response)
  {
    $this->record->code = $response->getStatus();
    $this->record->response = $response->getResponseString();
    $this->record->time = round((microtime(true) - $this->time) * 1000000);
    $this->record->save();
  }
}
