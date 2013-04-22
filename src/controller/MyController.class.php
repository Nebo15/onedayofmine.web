<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/News.class.php');

class MyController extends BaseJsonController
{
  function doProfile()
  {
    $user = $this->_getUser();
    if($this->request->isPost())
    {
      $properties = array('name', 'sex', 'location', 'occupation', 'birthday');
      foreach($properties as $property)
      {
        if($this->request->has($property))
          $user->set($property, $this->request->get($property));
      }

      if($this->request->has('image_content'))
        $user->attachImage(base64_decode($this->request->get('image_content')));

      if(!$user->validate($this->error_list))
      {
        return $this->_answerWithError($this->error_list->getReadable());
      }
      else
        $user->save();
    }

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($user));
  }

  function doSettings()
  {
    $user = $this->_getUser();
    if(!$this->request->isPost())
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

  function doNews()
  {
    $user  = $this->toolkit->getUser();

    list($from, $to, $limit) = $this->_getFromToLimitations();
    $news = $user->getNewsWithLimitation($from, $to, $limit);

    if($from && !$to && !count($news))
      return $this->_answerOk($news, 'Not Modified', 304);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportNewsItems($news));
  }

	function doMarkNewsAsRead()
	{
		if(!$this->request->isPost())
			return $this->_answerUnauthorized();

		$user  = $this->toolkit->getUser();

		$news_ids = $this->request->get('news_ids');
		array_walk($news_ids, function(&$id) {
			$id = (int) $id;
		});
		$news_ids = array_unique($news_ids);

		$user->markNewsAsRead($news_ids);

		return $this->_answerOk();
	}
}
