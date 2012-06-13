<?php
lmb_require('facebook/facebook.php');

class odFacebook extends Facebook
{
  function makeQuery($query)
  {
    return $this->api(
      array('method' => 'fql.query', 'query' => $query)
    );
  }

  function getTestUsers()
  {
    $params = array(
      'access_token' => $this->getApplicationAccessToken()
    );
    $user = $this->api("/".$this->getAppId()."/accounts/test-users", "GET", $params);
    return $user;
  }
}
