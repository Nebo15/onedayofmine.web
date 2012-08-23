<?php
lmb_require('src/controller/BaseJsonController.class.php');
lmb_require('src/model/User.class.php');

class UsersController extends BaseJsonController
{
  function doGuestDisplay()
  {
    return $this->_answerNotFound();
  }

  function doGuestItem()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User with id {$this->request->id} not found");
    else {
      $export = $user->exportForApi();
      if($user->getId() != lmbToolkit::instance()->getUser()->getId()) {
        $export->following = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $user);
        // $export->is_follower = UserFollowing::isFollowing($user, lmbToolkit::instance()->getUser());
      }

      return $this->_answerOk($export);
    }
  }

  function doGuestDays()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $answer = array();
    foreach($user_or_answer->getDays() as $day) {
      $export = $day->exportForApi();
      $this->_attachDayUser($export, $day);
      $this->_attachDayIsFavorited($export, $day);
      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doFollowers()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowers() as $follower) {
      $export = $follower->exportForApi();
      $export->following = UserFollowing::isFollowing(lmbToolkit::instance()->getUser(), $follower);
      $response[] = $export;
    }
    return $this->_answerOk($response);
  }

  function doFollowing()
  {
    $user_or_answer = $this->_loadUserFromRequest();
    if(!is_object($user_or_answer))
      return $user_or_answer;

    $response = array();
    foreach($user_or_answer->getFollowing() as $followed) {
      $export = $followed->exportForApi();
      // $export->is_follower = UserFollowing::isFollowing($followed, lmbToolkit::instance()->getUser());
      $response[] = $export;
    }
    return $this->_answerOk($response);
  }

  function doFollow()
  {
    if($this->_getUser()->getId() == $this->request->id)
      return $this->_answerWithError("You can't follow youself");

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
    if($this->_getUser()->getId() == $this->request->id)
      return $this->_answerWithError("You can't unfollow youself");

    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    $following = $this->_getUser()->getFollowing();
    $following->remove($user);
    $following->save();

    return $this->_answerOk();
  }

  function doGuestSearch()
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
