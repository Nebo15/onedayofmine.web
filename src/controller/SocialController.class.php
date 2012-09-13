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
    foreach($profile->getFriends() as $friend) {
      $friend = (object) $friend;
      unset($friend->email);
      unset($friend->timezone);
      unset($friend->facebook_profile_utime);
      unset($friend->work);
      unset($friend->current_location);

      if($user = User::findByFacebookUid($friend->facebook_uid)) {
        $friend->user = $user->exportForApi();
        $friend->user->following = UserFollowing::isUserFollowUser($this->_getUser(), $user);
      }
      else
        $friend->user = null;


      $friends[] = $friend;
    }

    return $this->_answerOk($friends);
  }

  function doTwitterConnect()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $this->_checkPropertiesInRequest(array('access_token', 'access_token_secret'));

    if($this->error_list->isEmpty())
    {
      $access_token        = $this->request->getPost('access_token');
      $access_token_secret = $this->request->getPost('access_token_secret');

      $provider = $this->toolkit->getTwitter($access_token, $access_token_secret);

      if(!$uid = $provider->getUid($this->error_list)) {
        return $this->_answerWithError($this->error_list->export());
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

  function doUserEmail()
  {
    if('invite' == $this->request->get('id'))
      return $this->_doEmailInvite();
  }

  protected function _doEmailInvite()
  {
    $errors = $this->_checkPropertiesInRequest(['email', 'name']);
    if(count($errors))
      return $this->_answerWithError($errors);

    $text =<<<EOD
Hello!

Your friend %name% wants you to become part of One Day of Mine community, where you can find out how another people live their days and share same information about you.";
EOD;

    $email = $this->request->get('email');
    $text = str_replace('%name%', $this->request->get('name'), $text);

    $this->toolkit->getMailer()->sendPlainMail($email, 'Invitation to One Day of Mine', $text);
    return $this->_answerOk();
  }
}
