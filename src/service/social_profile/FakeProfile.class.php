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
  function shareDayBegin(Day $day, $day_url) {}
  function shareDayEnd(Day $day, $day_url) {}
  function shareDay(Day $day, $day_url) {}
  function shareDayLike(Day $day, $day_url) {}
  function shareMomentAdd(Day $day, $day_url, Moment $moment, $moment_url) {}
  function shareMomentLike(Moment $moment, $moment_url) {}
  function getFriendsIds() {}
}
