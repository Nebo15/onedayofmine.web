<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class SocialController extends BaseJsonController
{
  function doFacebookFriends()
  {
    if(!$this->toolkit->getUser())
      $this->_answerUnauthorized();

    $friends = array();
    foreach($this->toolkit->getUser()->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getRegisteredFriends() as $friend) {
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

      $provider = $this->toolkit->getSocialServices()->getTwitter($access_token, $access_token_secret);

      if(!$provider->validateAccessToken()) {
        $this->error_list->addError("Access token seems to be unvalid.");
        return $this->_answerWithError($this->error_list->export(), null, 403);
      }

      $this->toolkit->getUser()->setTwitterUid(json_decode($provider->response['response'])->id);
      $this->toolkit->getUser()->setTwitterAccessToken($access_token);
      $this->toolkit->getUser()->setTwitterAccessTokenSecret($access_token_secret);
      $this->toolkit->getUser()->save();

      return $this->_answerOk($this->toolkit->getUser());
    }
    else
      return $this->_answerWithError($this->error_list->export());
  }

  // TODO add related objects (day/moment) to response
  function doNews() {
    if($this->request->getRequestMethod() != 'GET')
      return $this->_answerWithError('Not a GET request');

    $limit = lmbToolkit::instance()->getConf('common')->default_news_count;
    $user  = $this->toolkit->getUser();

    $first = $this->request->has('first') ? $this->request->getFiltered('first', FILTER_SANITIZE_NUMBER_INT) : null;
    $last  = $this->request->has('last')  ? $this->request->getFiltered('last', FILTER_SANITIZE_NUMBER_INT)  : null;

    if(is_null($first) && is_null($last)) {               // SELECT ... FROM ... ORDER BY DESC LIMIT 100
      $news = $user->getNews();
      $news->paginate(0, $limit);

    } elseif(!is_null($first) && is_null($last)) {        // SELECT ... FROM ... WHERE id < $first ORDER BY DESC LIMIT 100
      $news = News::findNewForUser($user, null, $first, $limit);

    } elseif(is_null($first) && !is_null($last)) {        // SELECT ... FROM ... WHERE id > $last ORDER BY DESC LIMIT 100
      $news = News::findNewForUser($user, $last, null, $limit);

      // If there are no new news, we return specific status code
      if(!$news->count())
        return $this->_answerOk($news, 'Not Modified', 304);

    } else {                                              // SELECT ... FROM ... WHERE $first < id AND id < $last ORDER BY DESC LIMIT 100
      if($last <= $first)
        return $this->_answerWithError("Last ID '{$last}' can't be less or equal to first ID '{$first}'.");

      $news = News::findNewForUser($user, $first, $last, $limit);
    }

    return $this->_answerOk($news);
  }
}
