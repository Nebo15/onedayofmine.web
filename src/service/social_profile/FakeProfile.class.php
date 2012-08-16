<?php
  lmb_require('src/service/social_profile/SocialServicesProfileInterface.class.php');
  lmb_require('src/service/social_profile/SharesInterface.class.php');

class FakeProfile implements SocialServicesProfileInterface, SharesInterface
{
  const ID = 'Fake';

  function __construct(User $user) {}
  function getProvider() {}
  function getInfo_Raw() {}
  function getInfo() {}
  function getFriends() { return array();}
  function getRegisteredFriends() { return array(); }
  function getPictures() {}
  function shareDayBegin(Day $day) {}
  function shareDayEnd(Day $day) {}
  function shareDay(Day $day) {}
  function shareDayLike(Day $day) {}
  function shareMomentAdd(Day $day, Moment $moment) {}
  function shareMomentLike(Moment $moment) {}
  function getFriendsIds() {}
}
