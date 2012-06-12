<?php

class FbForTests
{
  static function getUsers()
  {
    static $users;
    if(!$users)
    {
      $users_info = lmbToolkit::instance()->getFacebook()->getTestUsers();
      lmb_assert_true(count($users_info['data']) > 1);
      foreach($users_info['data'] as $key => $user_info)
      {
        $user = new User();
        $user->setFbUid($user_info['id']);
        $user->setFbAccessToken($user_info['access_token']);
        $users[] = $user;
      }
    }
    return $users;
  }
}
