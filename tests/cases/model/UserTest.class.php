<?php
lmb_require('tests/cases/odUnitTestCase.class.php');

class UserTest extends odUnitTestCase
{
  function testGetRegisteredFriendsFromFb()
  {
    $this->main_user->save();
    $this->additional_user->save();

    $friends = $this->main_user->getSocialProfile(odSocialServices::PROVIDER_FACEBOOK)->getRegisteredFriends();
    if($this->assertEqual(1, count($friends)))
      $this->assertEqual($this->additional_user->getId(), $friends[0]->getId());
  }
}
