<?php
  lmb_require('src/service/social_profile/SocialProfileInterface.class.php');
  lmb_require('src/service/social_profile/SharesInterface.class.php');

class FakeProfile implements SocialProfileInterface, SharesInterface
{
  const ID = 'Fake';

  function __construct(User $user) {}
  function getProvider() {}
  function getInfo_Raw() {}
  function getInfo() {}
  function getFriends() { return array();}
  function getRegisteredFriends() { return array(); }
  function getUserpic() {}
  function shareDayBegin(Day $day) {}
  function shareDayEnd(Day $day) {}
  function shareDay(Day $day) {}
  function shareDayLike(Day $day, DayLike $like) {}
  function shareDayUnlike(Day $day, DayLike $like) {}
  function shareDayDelete(Day $day) {}
  function shareMomentAdd(Day $day, Moment $moment) {}
  function shareMomentLike(Moment $moment, MomentLike $like) {}
  function shareMomentUnlike(Moment $moment, MomentLike $like) {}
  function shareMomentDelete(Day $day, Moment $moment) {}
  function shareInvitation($social_user_id) {}
  function getFriendsIds() {}
}
