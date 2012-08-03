<?php
interface SocialServicesProfileInterface
{
  public function __construct(User $user);
  public function getProvider();
  public function getInfo_Raw();
  public function getInfo();
  public function getFriends();
  public function getRegisteredFriends();
  public function getPictures();

  ###########################################################
  ###################### Share methods ######################
  ###########################################################
  function shareDayBegin($day_url);
  function shareDayEnd($day_url);
  function shareDay(Day $day, $day_url);
  function shareDayLike($day_url);
  function shareMomentAdd($moment_url, $day_url);
  function shareMomentLike($moment_url);
}
