<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MyController extends BaseJsonController
{
	function doProfile()
	{
    if(!$this->request->hasPost())
		  return $this->_answerOk($this->_getUser());
    else
    {
      $properties = array('first_name', 'last_name', 'location', 'occupation', 'birthday');
      foreach($properties as $property)
      {
        if($this->request->has($property))
          $this->_getUser()->set($property, $this->request->getPost($property));
      }
      $this->_getUser()->save();
      return $this->_answerOk($this->_getUser());
    }
	}

	function doSettings()
	{

	}
}
