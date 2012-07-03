<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UsersController extends BaseJsonController
{
  protected $check_auth = true;

  function doDays()
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

    $answer = array();
    foreach($user->getDays() as $day)
      $answer[] = $day->exportForApi();

    return $this->_answerOk($answer);
  }

  function doFollowers()
  {
    $response = array();
    foreach($this->_getUser()->getFollowers() as $follower)
      $response[] = $follower->exportForApi();
    return $this->_answerOk($response);
  }

  function doFollowing()
  {
    $response = array();
    foreach($this->_getUser()->getFollowing() as $follower)
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
}
