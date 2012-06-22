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
}
