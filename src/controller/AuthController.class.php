<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/DeviceToken.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/Invitation.class.php');

class AuthController extends BaseJsonController
{
  function doGuestParameters()
  {
    $answer = new stdClass();

    $answer->facebook = new stdClass();
    $answer->facebook->appid = $this->toolkit->getConf('facebook')['appId'];
    $answer->facebook->namespace = $this->toolkit->getConf('facebook')['namespace'];

    $answer->twitter = new stdClass();
    $answer->twitter->consumer_key = $this->toolkit->getConf('twitter')['consumer_key'];

    return $this->_answerOk($answer);
  }

  function doGuestMobileFacebookLogin()
  {
    $facebook = $this->toolkit->getFacebook();
    if(!$facebook->getUser()) {
	    $params = ['redirect_uri' => $this->toolkit->getSiteUrl('/auth/mobile_facebook_login?storage_key=' .
			    $facebook->getStorageKey())];
	    $this->response->redirect($facebook->getLoginUrl($params));
      return 'Redirecting...';
    } else {
      $this->response->redirect('odom://index.html#profile:token=' . $facebook->getAccessToken());
      return $this->_answerOk();
    }
  }

	function doGuestCheckInvitation()
	{
		if (!$this->request->isPost())
			return $this->_answerNotPost();

		if(!$invitation = Invitation::findOneByCode($this->request->getSafe('code')))
			return $this->_answerOk(false);
		return $this->_answerOk($invitation->max_count > $invitation->taken_count);
	}

  function doGuestLogin()
  {
    if (!$this->request->isPost())
      return $this->_answerNotPost();

    if (!$facebook_access_token = $this->toolkit->getTokenFromRequest())
      return $this->_answerWithError('Token not given', null, 412);

    if (!$uid = $this->toolkit->getFacebook($facebook_access_token)->getUid($this->error_list))
      return $this->_answerWithError($this->error_list, null, 403);

    $is_new_user = false;
    if (!$user = User::findByFacebookUid($uid)) {
	    if (!$invitation_code = $this->request->get('invitation_code'))
		    return $this->_answerWithError('Invitation not given', null, 412);

      $user = $this->_register($facebook_access_token, $invitation_code);
	    if(!$this->error_list->isEmpty())
		    return $this->_answerWithError($this->error_list->export(), null, 412);
      $is_new_user = true;
    } else {
      $user->facebook_access_token = $facebook_access_token;
      $user->save();
    }
    $this->toolkit->setUser($user);

    if ($is_new_user)
      $this->toolkit->doAsync('userCreate', $user->id);

    $this->_processDeviceToken($user);

    $this->response->setCookie('token', $facebook_access_token, time() + 60 * 60 * 24 * 31);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($user));
  }

  function _register($facebook_access_token, $invitation_code)
  {
	  $invitation = Invitation::findOneByCode($invitation_code);
	  if($invitation->max_count <= $invitation->taken_count)
		  return $this->error_list->addError('Invitation code expired');
	  $invitation->taken_count++;
	  $invitation->save();

    $user = new User();
	  $user->setInvitation($invitation);
    $user->facebook_access_token = $facebook_access_token;
    $profile = $this->toolkit->getFacebookProfile($user);
    $user->import($profile->getInfo());
    $user->save();

    $userpics = $profile->getUserpic();
    if (count($userpics)) {
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
    if (!$device_token)
      return;

    $token_obj = DeviceToken::findOneByToken($device_token);
    if ($token_obj && $token_obj->user_id != $user->id) {
      $token_obj->destroy();
      $token_obj = null;
    }

    if (!$token_obj) {
      $token_obj = new DeviceToken();
      $token_obj->import([
        'user_id' => $user->id,
        'token' => $device_token,
        'logins_count' => 1
      ]);
    } else {
      $token_obj->logins_count = $token_obj->logins_count++;
    }

    $token_obj->save();
  }

  function doGuestIsLoggedIn()
  {
    if (!$this->toolkit->getTokenFromRequest())
      return $this->_answerWithError('Token not given', null, 412);

    return $this->_answerOk($this->_isLoggedUser());
  }

  function doUserLogout()
  {
    if ($this->session->valid())
      $this->session->reset();

    $this->toolkit->resetUser();

    $this->response->removeCookie('token');

    if ($device_token = $this->request->get('device_token'))
      if ($token_obj = DeviceToken::findOneByToken($device_token))
        $token_obj->destroy();

    return $this->_answerOk();
  }
}
