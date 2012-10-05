<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/DeviceToken.class.php');
lmb_require('src/model/Day.class.php');

class AuthController extends BaseJsonController
{
  function doGuestParameters()
  {
    $answer = new stdClass();

    $answer->facebook               = new stdClass();
    $answer->facebook->appid        = $this->toolkit->getConf('facebook')['appId'];
    $answer->facebook->namespace    = $this->toolkit->getConf('facebook')['namespace'];

    $answer->twitter                = new stdClass();
    $answer->twitter->consumer_key  = $this->toolkit->getConf('twitter')['consumer_key'];

    return $this->_answerOk($answer);
  }

  function doGuestLogin()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$facebook_access_token = $this->toolkit->getTokenFromRequest())
      return $this->_answerWithError('Token not given', null, 412);

    if(!$uid = $this->toolkit->getFacebook($facebook_access_token)->getUid($this->error_list))
      return $this->_answerWithError($this->error_list, null, 403);

    $is_new_user = false;
    if(!$user = User::findByFacebookUid($uid))
    {
      $user = $this->_register($facebook_access_token);
      $is_new_user = true;
    }
    else
    {
      $user->setFacebookAccessToken($facebook_access_token);
      $user->save();
    }

    $this->toolkit->setUser($user);

    if($is_new_user)
      $this->toolkit->doAsync('userCreate', $user->id);

    $this->_processDeviceToken($user);

    $this->response->setCookie('token', $facebook_access_token, time()+60*60*24*31);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($user));
  }

  function _register($facebook_access_token)
  {
    $user = new User();
    $user->setFacebookAccessToken($facebook_access_token);
    $profile = $this->toolkit->getFacebookProfile($user);
    $user->import($profile->getInfo());
    $user->save();

    $userpics = $profile->getPictures();
    if(count($userpics)) {
      $userpic_url = array_pop($userpics); // Returns biggest picture
      $userpic_contents = $profile->getPictureContents($userpic_url);
      $user->attachImage($userpic_contents);
      $user->save();
    }

    return $user;
  }

  function _processDeviceToken($user)
  {
    $device_token = $this->request->get('device_token');
    if(!$device_token)
      return;

    $token_obj = DeviceToken::findOneByToken($device_token);
    if($token_obj && $token_obj->user_id != $user->id)
    {
      $token_obj->destroy();
      $token_obj = null;
    }

    if(!$token_obj)
    {
      $token_obj = new DeviceToken([
        'user_id' => $user->id,
        'token' => $device_token,
        'logins_count' => 1
      ]);
    }
    else
    {
      $token_obj->logins_count = $token_obj->logins_count++;
    }

    $token_obj->save();
  }

  function doGuestIsLoggedIn()
  {
    if(!$this->toolkit->getTokenFromRequest())
      return $this->_answerWithError('Token not given', null, 412);

    return $this->_answerOk($this->_isLoggedUser());
  }

  function doUserLogout()
  {
    if($this->session->valid())
      $this->session->reset();

    $this->toolkit->resetUser();

    $this->response->removeCookie('token');

    if($device_token = $this->request->get('device_token'))
      if($token_obj = DeviceToken::findOneByToken($device_token))
        $token_obj->destroy();

    return $this->_answerOk();
  }
}


