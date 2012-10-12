<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class AuthControllerIntegrationTest extends odIntegrationTestCase
{
  /**
   * @api
   */
  function testLogin()
  {
    $this->main_user->save();

    $response = $this->_login($this->main_user);
    if($this->assertResponse(200))
    {
      $this->assertCookie('token');
      $this->assertEqual($this->getCookie('token'), $this->main_user->facebook_access_token);
      $this->assertJsonUser($response->result);
    }

    $response = $this->get('auth/is_logged_in');
    if($this->assertResponse(200))
    {
      $this->assertTrue($response->result);
    }
  }
}
