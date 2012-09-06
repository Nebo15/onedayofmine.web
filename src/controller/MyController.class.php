<?php
lmb_require('src/controller/BaseJsonController.class.php');

class MyController extends BaseJsonController
{
  function doProfile()
  {
    $user = $this->_getUser();
    if($this->request->isPost())
    {
      $properties = array('name', 'sex', 'email', 'location', 'occupation', 'birthday');
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

    $answer = $user->exportForApi();
    $answer->favourites_count = $user->getFavouriteDays()->count();
    $answer->days_count = $user->getDays()->count();
    $answer->email = $user->getEmail();
    return $this->_answerOk($answer);
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
    $news = News::findNewsForUser($user, $from, $to, $limit);

    if($from && !$to && !count($news))
      return $this->_answerOk($news, 'Not Modified', 304);

    $response = array();
    foreach ($news as $id => $post) {
      $export = $post->exportForApi();
      $export->user = $post->getSender()->exportForApi();

      if($post->getDay())
        $export->day = $post->getDay()->exportForApi();
      elseif($post->getMoment()) {
        $export->day = $post->getMoment()->getDay()->exportForApi();
        $export->moment = $post->getMoment()->exportForApi();
        unset($export->moment->day_id);
      }

      unset($export->user_id);
      unset($export->day_id);
      unset($export->moment_id);

      $response[] = $export;
    }

    return $this->_answerOk($response);
  }
}
