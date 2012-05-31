<?php
lmb_require('src/controller/JsonController.class.php');
lmb_require('src/model/Day.class.php');

class AuthController extends JsonController
{
  function doLogin()
  {
    if(!$this->request->hasPost())
      return $this->_answerWithError('Not a POST request', 400);
    if(!$fb_user_id = $this->request->get('fb_user_id'))
      return $this->_answerWithError('fb_user_id not given', 412);
    if(!$fb_access_token = $this->request->get('fb_access_token'))
      return $this->_answerWithError('fb_access_token not given', 412);

    if($user = User::findByFbIdAndToken($fb_user_id, $fb_access_token))
    {
      $this->toolkit->setUser($user);
      return $this->_answerOk(array('sessid' => session_id()));
    }
    else
      return $this->_answer(401, 'Wrong ID/token combination');
  }

  function doLogout()
  {
    $this->toolkit->resetUser();
    return $this->_answerOk();
  }
}
