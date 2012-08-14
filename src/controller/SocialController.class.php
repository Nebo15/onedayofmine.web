<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class SocialController extends BaseJsonController
{
  function doFacebookFriends()
  {
    if(!$this->_getUser())
      $this->_answerUnauthorized();

    $friends = array();
    foreach($this->toolkit->getFacebookProfile($this->_getUser())->getRegisteredFriends() as $friend) {
      $friend = $friend->exportForApi();
      unset($friend->user_info['email']);
      unset($friend->user_info['timezone']);
      unset($friend->user_info['fb_profile_utime']);
      unset($friend->user_info['fb_uid']);
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

      if(!$provider->getUid($this->error_list)) {
        return $this->_answerWithError($this->error_list->export(), null, 403);
      }

      $this->toolkit->getUser()->setTwitterAccessToken($access_token);
      $this->toolkit->getUser()->setTwitterAccessTokenSecret($access_token_secret);

      // 2 requests is not optimal solution
      $twitter_uid = lmbToolkit::instance()->getTwitterProfile($this->_getUser())->getInfo()['twitter_uid'];
      $this->toolkit->getUser()->setTwitterUid($twitter_uid);

      $this->toolkit->getUser()->save();

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
