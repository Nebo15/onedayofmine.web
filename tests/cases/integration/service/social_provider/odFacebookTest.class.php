<?php
lmb_require('tests/cases/integration/odIntegrationTestCase.class.php');

class odFacebookTest extends odIntegrationTestCase
{
  function testApi_ExpiredToken()
  {
    $fb = lmbToolkit::instance()->getFacebook('AAAFnVo0zuqkBAAtyBDPbkabDQWFZBikQ5YrQMy0ZBIanOeW51UCGB2QXp0CpcvedgsHsWkUOFopNlOek8ZCz7zy0hNBuBSx94WwdC4iryMao31P9Ytm');

    try
    {
      $fb->api('/me');
      $this->fail();
    }
    catch(odFacebookApiExpiredTokenException $e) {}
  }
}
