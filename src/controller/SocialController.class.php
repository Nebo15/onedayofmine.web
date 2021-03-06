<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class SocialController extends BaseJsonController
{
  function doFacebookFriends()
  {
    $friends = $this->toolkit->getFacebookProfile($this->_getUser())->getFriends();
    return $this->_answerOk($this->toolkit->getExportHelper()->exportFacebookUserItems($friends));
  }

  function doFacebookInvite()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    if(!$uid = $this->request->getPost('uid'))
      return $this->_answerWithError('You need to specify facebook user uid');

    if($user = User::findByFacebookUid($uid))
      return $this->_answerOk('User is already registered');

    $this->toolkit->doAsync('facebookInvite', $this->_getUser()->id, $uid);

    return $this->_answerOk();
  }

  function doTwitterConnect()
  {
    if(!$this->request->isPost())
      return $this->_answerNotPost();

    $this->_checkPropertiesInRequest(array('access_token', 'access_token_secret'));

    if(!$this->error_list->isEmpty())
      return $this->_answerWithError($this->error_list->export());

    $access_token        = $this->request->getPost('access_token');
    $access_token_secret = $this->request->getPost('access_token_secret');

    $provider = $this->toolkit->getTwitter($access_token, $access_token_secret);

    if(!$uid = $provider->getUid($this->error_list))
      return $this->_answerWithError($this->error_list->export());

    $user = $this->toolkit->getUser();
    $user->twitter_uid = $uid;
    $user->twitter_access_token = $access_token;
    $user->twitter_access_token_secret = $access_token_secret;
    $user->save();
    $settings = $user->getSettings();
    $settings->social_share_twitter = 1;
    $settings->save();

    return $this->_answerOk();
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

    $this->toolkit->doAsync('emailInvite', $this->request->get('email'), $this->request->get('name'));

    return $this->_answerOk();
  }
}
