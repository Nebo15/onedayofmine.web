<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class SocialAcceptanceTest extends odAcceptanceTestCase
{
  /**
   *@example
   */
  function testFacebookFiends()
  {
    $this->main_user->save();
    $this->additional_user->save();
    $this->_loginAndSetCookie($this->main_user);

    $result = $this->get('social/facebook_friends');
    $friends = $result->result;
    $this->assertResponse(200);
    $this->assertTrue(is_array($friends));
    $this->assertEqual(1, count($friends));
    $this->assertEqual($friends[0]->fb_uid, $this->additional_user->getFbUid());
  }

  /**
   * example
   * todo-high
   */
  function testFacebookInvite() {}

  /**
   * example
   * todo-high
   */
  function testTwitterConnect() {}

  /**
   * example
   * todo-high
   */
  function testEmailInvite() {}
}
