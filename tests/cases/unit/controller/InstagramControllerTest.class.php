<?php
lmb_require('tests/cases/unit/controller/odControllerTestCase.class.php');
lmb_require('src/controller/InstagramControllerTest.class.php');

class InstagramControllerTest extends odControllerTestCase
{
	protected $controller_class = 'InstagramController';

	function testLoginUrl()
	{
		$this->main_user->save();

		$response = $this->get('login_url');

		if($this->assertResponse(401))
		{
			$this->assertTrue(is_null($response->result));

			$this->assertEqual(1, count($response->errors));
			$this->assertEqual("Current user don't have permission to perform this action", $response->errors[0]);
		}
	}
}
