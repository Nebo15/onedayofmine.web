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
    $user = $this->_getUser();
    if(!$this->request->hasPost())
      return $this->_answerOk($user->getSettings());
    else
    {
      $settings = $user->getSettings();
      foreach($this->request->export() as $property => $value)
      {
        if($settings->has($property))
          $settings->set($property, (int) $value);
      }
      $settings->save($this->error_list);
      if($this->error_list->isValid())
        return $this->_answerOk($settings);
      else
        return $this->_answerWithError($this->error_list);
    }
	}
}
