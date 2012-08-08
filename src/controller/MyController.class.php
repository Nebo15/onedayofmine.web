<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MyController extends BaseJsonController
{
	function doProfile()
	{
    if($this->request->hasPost())
    {
      $properties = array('name', 'email', 'location', 'occupation', 'birthday');
      foreach($properties as $property)
      {
        if($this->request->has($property))
          $this->_getUser()->set($property, $this->request->getPost($property));
      }

      if($this->request->has('image_name') && $this->request->has('image_conetent'))
        $this->_getUser()->attachImage(
          $this->request->get('image_name'),
          base64_decode($this->request->get('image_conetent'))
        );

      $this->_getUser()->save();
    }

    $answer = $this->_getUser()->exportForApi();
    $answer->email = $this->_getUser()->getEmail();
    return $this->_answerOk($answer);
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
