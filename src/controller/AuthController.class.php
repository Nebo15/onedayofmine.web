<?php
lmb_require('src/controller/JsonController.class.php');
lmb_require('src/model/Day.class.php');

class AuthController extends JsonController
{
  protected $check_auth = false;

  function doLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answer(null, 405, 'Use POST, Luke');
    if(!$fb_user_id = $this->request->get('fb_user_id'))
      return $this->_answer('fb_user_id not given', 412);
    if(!$fb_access_token = $this->request->get('fb_access_token'))
      return $this->_answer('fb_access_token not given', 412);

    if($user = User::findByFbIdAndToken($fb_user_id, $fb_access_token))
    {
      $this->toolkit->setUser($user);
      return $this->_answer(array('sessid' => session_id()));
    }
    else
      return $this->_answer(null, 401, 'Wrong ID/token combination');
  }

  function doIsLoggedIn()
  {
    return $this->_answer($this->_isLoggedUser());
  }

  function doLogout()
  {
    if($this->session->valid()) $this->session->reset();
    return $this->_answer();
  }
}
