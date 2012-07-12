<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UsersController extends BaseJsonController
{
  protected $check_auth = true;

  function doItem()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User with id {$this->request->id} not found");
    else
      return $this->_answerOk($user);
  }

  function doDays()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $answer = array();
    foreach($user_or_answer->getDays() as $day)
      $answer[] = $day->exportForApi();

    return $this->_answerOk($answer);
  }

  function doFollowers()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowers() as $follower)
      $response[] = $follower->exportForApi();
    return $this->_answerOk($response);
  }

  function doFollowing()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowing() as $follower)
      $response[] = $follower->exportForApi();
    return $this->_answerOk($response);
  }

  function doFollow()
  {
  	if(!$user = User::findById($this->request->id))
  		return $this->_answerNotFound("User not found by id '{$this->request->id}'");

  	$following = $this->_getUser()->getFollowing();
  	$following->add($user);
  	$following->save();

  	return $this->_answerOk();
  }

  function doUnfollow()
  {
  	if(!$user = User::findById($this->request->id))
  		return $this->_answerNotFound("User not found by id '{$this->request->id}'");

  	$following = $this->_getUser()->getFollowing();
  	$following->remove($user);
  	$following->save();

  	return $this->_answerOk();
  }

  protected function _loadUserFromRequest()
  {
    if(!$this->request->has('id'))
  	{
      if(!$user = $this->_getUser())
        return $this->_answerUnauthorized();
  	}
    else
    {
      if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User with id {$this->request->id} not found");
    }

    return $user;
  }
}
