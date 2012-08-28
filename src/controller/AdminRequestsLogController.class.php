<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');

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
}
