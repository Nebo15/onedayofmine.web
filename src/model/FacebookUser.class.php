<?php

class FacebookUser
{
  /**
   * @var User
   */
  protected $user;

  function __construct(User $user)
  {
    $this->user = $user;
  }

  function getFacebook()
  {
    lmb_assert_true($this->user->getFbAccessToken());
    return lmbToolkit::instance()->getFacebook($this->user->getFbAccessToken());
  }

  function beginDay(Day $day)
  {
    return $this->getFacebook()->api("/me/one-day-of-mine:begin", "post", array(
      'day' => lmbToolkit::instance()->getSiteUrl('/days/'.$day->getId().'/item')
    ));
  }

  function shareDay(Day $day)
  {
    //http://developers.facebook.com/docs/reference/api/post/
    return $this->getFacebook()->api("/me/feed", "post", array(
      'name' => $day->getTitle(),
      'picture' => $this->getSiteUrl($day->getMoments()->at(0)->getImageUrl()),
      'link' => $this->getSiteUrl('/days/'.$day->getId().'/item'),
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  function likeDay(Day $link_to_object)
  {
    return $this->getFacebook()->api("/me/og.likes", "post", array(
      'object' => $link_to_object
    ));
  }

  function getSiteUrl($path)
  {
    return lmbToolkit::instance()->getSiteUrl($path);
  }
}
