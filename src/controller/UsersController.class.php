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
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    $export = $user->exportForApi();

    if($user->getId() != lmbToolkit::instance()->getUser()->getId()) {
      $export->following = UserFollowing::isUserFollowUser(lmbToolkit::instance()->getUser(), $user);
      // $export->is_follower = UserFollowing::isUserFollowUser($user, lmbToolkit::instance()->getUser());
    }

    return $this->_answerOk($export);
  }

  function doGuestDays()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    $answer = array();
    foreach($user->getDays() as $day) {
      $export = $day->exportForApi();
      $this->_attachDayUser($export, $day);
      $this->_attachDayIsFavorited($export, $day);
      $answer[] = $export;
    }

    return $this->_answerOk($answer);
  }

  function doFollowers()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    $followers = $user->getFollowers();
    $following = UserFollowing::isUserFollowUsers($user, $followers);

    $response = array();
    foreach($user->getFollowers() as $follower) {
      $export = $follower->exportForApi();
      $export->following = $following[$follower->getId()];
      $response[] = $export;
    }

    return $this->_answerOk($response);
  }

  function doFollowing()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    $response = array();
    foreach($user->getFollowing() as $followed) {
      $response[] = $followed->exportForApi();
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

    $this->toolkit->getNewsObserver()->onFollow($user);

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
        $export->is_follower = UserFollowing::isUserFollowUser($user, $this->_getUser());
      $response[] = $export;
    }
    return $this->_answerOk($response);
  }

  function doUserActivity()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerNotFound("User not found by id '{$this->request->id}'");

    list($from, $to, $limit) = $this->_getFromToLimitations();
    return $this->_answerOk($user->getActivitiesWithLimitation($from, $to, $limit));
  }
}
