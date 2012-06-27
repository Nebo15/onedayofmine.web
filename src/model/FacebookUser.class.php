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

  function postOnWall($message, $image_url, $link)
  {
    //http://developers.facebook.com/docs/reference/api/post/
    return $this->getFacebook()->api("/me/feed", "post", array(
      'type' => 'photo',
      'name' => $message,
      'picture' => $image_url,
      'link' => $link,
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }
}
