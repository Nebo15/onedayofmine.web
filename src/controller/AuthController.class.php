<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/DayTest.class.php');

class AuthController extends BaseJsonController
{
  protected $check_auth = false;

  function doLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answerOk(null, 405, 'Use POST, Luke');
    if(!$fb_access_token = $this->request->get('fb_access_token'))
      return $this->_answerOk('fb_access_token not given', 412);

    if(!$this->toolkit->getFacebook($fb_access_token)->validateAccessToken($this->error_list))
      return $this->_answerWithError($this->error_list, null, 403);

    if(!$user = User::findByFbAccessToken($fb_access_token))
      $user = $this->_register($fb_access_token);

    $this->toolkit->setUser($user);

    $answer = new stdClass();
    $answer->sessid = session_id();
    $answer->user = $user->exportForApi();

    return $this->_answerOk($answer);
  }

  function _register($fb_access_token)
  {
    $user = new User();
    $user->setFbAccessToken($fb_access_token);
    $fb_user_info = $user->getUserInfo();
    $user->setFbUid($fb_user_info['fb_uid']);
    $user->save();
    return $user;
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


