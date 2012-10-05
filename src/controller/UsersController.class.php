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
      return $this->_answerModelNotFoundById('User', $this->request->id);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUser($user));
  }

  function doGuestDays()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

    return $this->_answerOk($this->toolkit->getExportHelper()->exportDayItems($user->getDays()));
  }

  function doGuestFollowers()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

    $followers = $user->getFollowers();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUserItems($followers));
  }

  function doGuestFollowing()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

    $followed_users = $user->getFollowing();

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUserItems($followed_users));
  }

  function doFollow()
  {
    if($this->_getUser()->getId() == $this->request->id)
      return $this->_answerWithError("You can't follow youself");

    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

    $following = $this->_getUser()->getFollowing();
    $following->add($user);
    $following->save();

    $this->toolkit->doAsync('userFollow', $user->id);

    return $this->_answerOk();
  }

  function doUnfollow()
  {
    if($this->_getUser()->getId() == $this->request->id)
      return $this->_answerWithError("You can't unfollow youself");

    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

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

    return $this->_answerOk($this->toolkit->getExportHelper()->exportUserItems($users));
  }

  function doGuestActivity()
  {
    if(!$user = User::findById($this->request->id))
      return $this->_answerModelNotFoundById('User', $this->request->id);

    list($from, $to, $limit) = $this->_getFromToLimitations();
    return $this->_answerOk($user->getActivitiesWithLimitation($from, $to, $limit));
  }
}
