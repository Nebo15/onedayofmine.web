<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UsersController extends BaseJsonController
{
  protected $check_auth = false;

  function doItem()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User with id {$this->request->id} not found");
    else {
      $export = $user->exportForApi();
      if($user->getId() != lmbToolkit::instance()->getUser()->getId()) {
        $export->is_followed = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $user);
        $export->is_follower = UserFollowing::isFollowing($user, lmbToolkit::instance()->getUser());
      }

      return $this->_answerOk($export);
    }
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
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowers() as $follower) {
      $export = $follower->exportForApi();
      $export->is_followed = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $follower);
      $response[] = $export;
    }
    return $this->_answerOk($response);
  }

  function doFollowing()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowing() as $followed) {
      $export = $followed->exportForApi();
      $export->is_follower = UserFollowing::isFollowing($followed, lmbToolkit::instance()->getUser());
      $response[] = $export;
    }
    return $this->_answerOk($response);
  }

  function doFollow()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

    if($this->_getUser()->getId() == $this->request->id)
      return $this->_answerWithError("You can't follow youself.");

  	if(!$user = User::findById($this->request->id))
  		return $this->_answerNotFound("User not found by id '{$this->request->id}'");

  	$following = $this->_getUser()->getFollowing();
  	$following->add($user);
  	$following->save();

    // Notify user that somebody follow hem
    $this->toolkit->getNewsObserver()->notify(odNewsObserver::ACTION_NEW_FOLLOW, $user);

  	return $this->_answerOk();
  }

  function doUnfollow()
  {
    if(!$this->_isLoggedUser())
      return $this->_answerUnauthorized();

  	if(!$user = User::findById($this->request->id))
  		return $this->_answerNotFound("User not found by id '{$this->request->id}'");

  	$following = $this->_getUser()->getFollowing();
  	$following->remove($user);
  	$following->save();

  	return $this->_answerOk();
  }

  function doSearch()
  {
    list($from, $to, $limit) = $this->_getFromToLimitations();
    $query = $this->request->getFiltered('query', FILTER_SANITIZE_STRING);
    $users = User::findByString($query, $from, $to, $limit);

    $response = array();
    foreach($users as $user) {
      $export = $user->exportForApi();
      if($this->_getUser())
        $export->is_follower = UserFollowing::isFollowing($user, $this->_getUser());
      $response[] = $export;
    }
    return $this->_answerOk($response);
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
