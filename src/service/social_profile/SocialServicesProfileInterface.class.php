<?php
interface SocialServicesProfileInterface
{
  function __construct(User $user);
  function getProvider();
  function getInfo_Raw();
  function getInfo();
  function getFriends();
  function getRegisteredFriends();
  function getPictures();
  function shareDayBegin(Day $day, $day_url);
  function shareDayEnd(Day $day, $day_url);
  function shareDay(Day $day, $day_url);
  function shareDayLike(Day $day, $day_url);
  function shareMomentAdd(Day $day, $day_url, Moment $moment, $moment_url);
  function shareMomentLike(Moment $moment, $moment_url);
}
