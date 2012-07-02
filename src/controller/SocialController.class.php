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
    foreach($this->toolkit->getUser()->getUserFriendsInApplicationFromFb() as $friend)
      $friends[] = $friend->exportForApi();

    return $this->_answerOk($friends);
  }
}
