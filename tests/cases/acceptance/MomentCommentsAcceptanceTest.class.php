<?php
lmb_require('tests/cases/odAcceptanceTestCase.class.php');

class MomentCommentsAcceptanceTest extends odAcceptanceTestCase
{
	function setUp()
	{
		parent::setUp();
		odTestsTools::truncateTablesOf('Day', 'Moment', 'MomentComment');
	}

	/**
	 * @api
	 */
	function testUpdate()
	{
		$this->main_user->save();
		$comment = $this->generator->momentComment(null, $this->main_user);
		$comment->save();
		$new_comment_text = $this->generator->string(8);

		$this->_loginAndSetCookie($this->main_user);
		$this->post('/moment_comments/'.$comment->getId().'/update', array('text' => $new_comment_text));
		$this->assertResponse(200);

		$loaded_comment = MomentComment::findById($comment->getId());
		$this->assertEqual($new_comment_text, $loaded_comment->text);
	}

	function testUpdate_WrongUser()
	{
		$this->main_user->save();
		$comment = $this->generator->momentComment(null, $this->main_user);
		$comment->save();
		$new_comment_text = $this->generator->string(8);

		$this->_loginAndSetCookie($this->additional_user);
		$this->post('/moment_comments/'.$comment->getId().'/update', array('text' => $new_comment_text));
		$this->assertResponse(404);
	}

	/**
	 * @api
	 */
	function testDelete()
	{
		$this->main_user->save();
		$comment = $this->generator->momentComment(null, $this->main_user);
		$comment->save();
		$new_comment_text = $this->generator->string(8);

		$this->_loginAndSetCookie($this->main_user);
		$this->post('/moment_comments/'.$comment->getId().'/delete', array('text' => $new_comment_text));
		$this->assertResponse(200);

		$loaded_comment = MomentComment::findById($comment->getId());
		$this->assertFalse($loaded_comment);
	}

	function testDelete_WrongUser()
	{
		$this->main_user->save();
		$comment = $this->generator->momentComment(null, $this->main_user);
		$comment->save();
		$new_comment_text = $this->generator->string(8);

		$this->_loginAndSetCookie($this->additional_user);
		$this->post('/moment_comments/'.$comment->getId().'/delete', array('text' => $new_comment_text));
		$this->assertResponse(404);
	}
}
