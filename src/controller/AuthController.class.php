<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class AuthController extends BaseJsonController
{
  function doGuestLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Use POST, Luke', null, 405);
    if(!$fb_access_token = $this->request->get('token'))
      return $this->_answerWithError('Token not given', null, 412);

    if(!$this->toolkit->getFacebook($fb_access_token)->validateAccessToken($this->error_list))
      return $this->_answerWithError($this->error_list, null, 403);

    $new_user = false;
    $facebook_info = null;
    if(!$user = User::findByFbAccessToken($fb_access_token)) {
      $user = $this->_register($fb_access_token, $facebook_info);
      if($this->request->get('disable_sharing'))
      {
        $settings = $user->getSettings();
        $settings->setSocialShareTwitter(0);
        $settings->setSocialShareFacebook(0);
        $settings->save();
        $user->setSettings($settings);
      }
      $new_user = true;
    }

    $this->toolkit->setUser($user);

    if($new_user)
      $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_USER, $user);

    $answer = $user->exportForApi();
    $answer->favourites_count = $this->_getUser()->getFavouriteDays()->count();
    $answer->days_count = $this->_getUser()->getDays()->count();
    $answer->email = $this->_getUser()->getEmail();

    return $this->_answerOk($answer);
  }

  function _register($fb_access_token)
  {
    $user = new User();
    $user->setFbAccessToken($fb_access_token);
    $profile = $this->toolkit->getFacebookProfile($user);
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
    if(!$this->request->get('token'))
      return $this->_answerWithError('Token not given', null, 412);

    return $this->_answerOk($this->_isLoggedUser());
  }

  function doGuestLogout()
  {
    if($this->session->valid()) $this->session->reset();
    return $this->_answerOk();
  }
}


