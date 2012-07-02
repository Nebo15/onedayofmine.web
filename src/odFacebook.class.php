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

  function validateAccessToken($error_list)
  {
    try
    {
      $this->api('/me');
      return true;
    }
    catch (Exception $e)
    {
      $error_list[] = $e->getMessage();
      return false;
    }
  }
}
