<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class AuthController extends BaseJsonController
{
  function doGuestLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answerOk(null, 405, 'Use POST, Luke');
    if(!$fb_access_token = $this->request->get('token'))
      return $this->_answerOk('Token not given', 412);

    if(!$this->toolkit->getSocialServices()->getFacebook($fb_access_token)->validateAccessToken($this->error_list))
      return $this->_answerWithError($this->error_list, null, 403);

    $new_user = false;
    $facebook_info = null;
    if(!$user = User::findByFbAccessToken($fb_access_token)) {
      $user = $this->_register($fb_access_token, $facebook_info);
      $new_user = true;
    }

    $this->toolkit->setUser($user);

    $answer = new stdClass();
    $answer->user = $user->exportForApi();

    // Notify friends that they'r friend registered
    if($new_user)
    {
      $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_USER, $user);
    }

    $answer->user->followers = array();
    foreach ($user->getFollowers() as $follower) {
      $answer->user->followers[] = $follower->exportForApi();
    }

    $answer->user->following = array();
    foreach ($user->getFollowing() as $followed) {
      $answer->user->following[] = $followed->exportForApi();
    }

    $answer->user->email = $user->getEmail();

    return $this->_answerOk($answer);
  }

  function _register($fb_access_token)
  {
    $user = new User();
    $user->setFbAccessToken($fb_access_token);
    $profile = $user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK);
    $facebook_info = $profile->getInfo();
    $user->import($facebook_info);
    $user->save();

    $userpics = $profile->getPictures();
    $userpic_url = array_pop($userpics); // Returns biggest picture
    $userpic_contents = $profile->getPictureContents($userpic_url);
    $user->attachImage($userpic_contents);
    $user->save();

    return $user;
  }

  function doGuestIsLoggedIn()
  {
    return $this->_answerOk($this->_isLoggedUser());
  }

  function doGuestLogout()
  {
    if($this->session->valid()) $this->session->reset();
    return $this->_answerOk();
  }
}


