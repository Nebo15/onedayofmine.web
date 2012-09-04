<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('tests/src/odPostmanWriter.class.php');

class AdminRequestsLogController extends lmbController
{
  function doDisplay()
  {
    $criteria = new lmbSQLCriteria();

    if($this->request->get('filter_path'))
      $criteria->add(lmbSQLCriteria::equal('path', urldecode($this->request->get('filter_path'))));

    echo (int) $this->request->get('filter_code');

    if($this->request->get('filter_code'))
      $criteria->add(lmbSQLCriteria::equal('code', (int) $this->request->get('filter_code')));

    $this->items = RequestsLogRecord::find(array('criteria' => $criteria));

    $this->useForm('filter_form', $this->request);
  }

  function doRequest()
  {
    $this->item = RequestsLogRecord::findById($this->request->get('id'));
  }

  function doResponse()
  {
    $this->item = RequestsLogRecord::findById($this->request->get('id'));
  }

  function doPostmanCollection()
  {
    $this->response->setContentType('application/octet-stream');

    $postman_writter = new odPostmanWriter();

    $item = RequestsLogRecord::findById($this->request->get('id'));

    $data = unserialize($item->post);
    $postman_writter->addRequest($item->path, $item->path, $item->method, (array) $data);
    $content = $postman_writter->getCollectionContent(
      date('Y.m.d H:i:s', $item->ctime).' '.$item->path
    );

    $this->response->append($content);
    $this->response->commit();
  }
}
