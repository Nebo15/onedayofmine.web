<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class SocialController extends BaseJsonController
{
  function doFacebookFriends()
  {
    if(!$this->_getUser())
      $this->_answerUnauthorized();

    $profile = new FacebookProfile($this->_getUser());
    $friends = array();
    foreach($profile->getRegisteredFriends() as $friend) {
      $friend = $friend->exportForApi();
      unset($friend->user_info['email']);
      unset($friend->user_info['timezone']);
      unset($friend->user_info['facebook_profile_utime']);
      unset($friend->user_info['facebook_uid']);
      $friends[] = $friend;
    }

    return $this->_answerOk($friends);
  }

  function doTwitterConnect()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request');

    $this->_checkPropertiesInRequest(array('access_token', 'access_token_secret'));

    if($this->error_list->isEmpty())
    {
      $access_token        = $this->request->getPost('access_token');
      $access_token_secret = $this->request->getPost('access_token_secret');

      $provider = $this->toolkit->getTwitter($access_token, $access_token_secret);

      if(!$uid = $provider->getUid($this->error_list)) {
        return $this->_answerWithError($this->error_list->export(), null, 403);
      }

      $user = $this->toolkit->getUser();
      $user->setTwitterUid($uid);
      $user->setTwitterAccessToken($access_token);
      $user->setTwitterAccessTokenSecret($access_token_secret);
      $user->getSettings()->setSocialShareTwitter(1);
      $user->save();

      return $this->_answerOk($this->toolkit->getUser());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  function doNews() {
    if($this->request->getRequestMethod() != 'GET')
      return $this->_answerWithError('Not a GET request');

    $user  = $this->toolkit->getUser();

    list($from, $to, $limit) = $this->_getFromToLimitations();
    $news = News::findNewsForUser($user, $from, $to, $limit);

    if($from && !$to && !count($news))
      return $this->_answerOk($news, 'Not Modified', 304);

    $response = array();
    foreach ($news as $id => $post) {
      $export = $post->exportForApi();
      $export->user = $post->getUser()->exportForApi();

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
