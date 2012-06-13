<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');


class MomentAcceptanceTest extends odAcceptanceTestCase
{
  function testUpdate()
  {
    $this->post('moment/update');
    $this->assertResponse(200);
  }

  function testDelete()
  {
    $this->post('moment/delete');
    $this->assertResponse(200);
  }

  function testComment()
  {
    $this->post('moment/comment');
    $this->assertResponse(200);
  }

  function testShare()
  {
    $this->post('moment/share');
    $this->assertResponse(200);
  }
}
