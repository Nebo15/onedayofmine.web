<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MyController extends BaseJsonController
{
	function doProfile()
	{
		return $this->_answerOk($this->_getUser());
	}

	function doSettings()
	{

	}
}