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
    foreach($this->toolkit->getUser()->getFacebookUser()->getUserFriendsInApplication() as $friend)
      $friends[] = $friend->exportForApi();

    return $this->_answerOk($friends);
  }

  function doNews() {
    if($this->request->getRequestMethod() != 'GET')
      return $this->_answerWithError('Not a GET request');

    $limit = lmbToolkit::instance()->getConf('common')->default_news_count;
    $user  = $this->toolkit->getUser();

    if($this->request->has('last')) {
      $last  = $this->request->getFiltered('last', FILTER_SANITIZE_NUMBER_INT);

      if($this->request->has('first')) {
        // Get from archive (SELECT ... WHERE $first < id AND id < $last)
        $first = $this->request->getFiltered('first', FILTER_SANITIZE_NUMBER_INT);
        $news = News::findNewForUser($user, $first, $last);
      } else {
        // Get new after id (SELECT ... WHERE $last < id)
        $news = News::findNewForUser($user, $last);

        // If there are no new news, we return specific status code
        if(!$news->count())
          return $this->_answerOk($news, 'Not Modified', 304);
      }
    } else { // Get last N news request
      $news = $user->getNews(array('limit' => $limit));
    }

    return $this->_answerOk($news, 303);
  }
}
