<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');

class AuthController extends BaseJsonController
{
  protected $check_auth = false;

  function doLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answerOk(null, 405, 'Use POST, Luke');
    if(!$fb_access_token = $this->request->get('fb_access_token'))
      return $this->_answerOk('fb_access_token not given', 412);

    if(!$user = User::findByFbAccessToken($fb_access_token))
    {
      $user = new User();
      $user->setFbAccessToken($fb_access_token);
      $fb_user_info = $user->getUserInfo();
      $user->setFbUid($fb_user_info['fb_uid']);
      $user->save();
    }
    else
    {
      $user->loadUserInfoFromFb();
    }
    $this->toolkit->setUser($user);

    $answer = new stdClass();
    $answer->sessid = session_id();
    $answer->user = $user->exportToSimpleObj();

    return $this->_answerOk($answer);
  }

  function doIsLoggedIn()
  {
    return $this->_answerOk($this->_isLoggedUser());
  }

  function doLogout()
  {
    if($this->session->valid()) $this->session->reset();
    return $this->_answerOk();
  }
}


