<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/ExternalPhotosAnalyzer.class.php');
lmb_require('src/model/Day.class.php');
lmb_require('src/model/User.class.php');

class ExternalPhotoAnalyzerTest extends odUnitTestCase
{
	/**
	 * @var ExternalPhotosAnalyzer
	 */
	protected $service;
	function setUp()
	{
		parent::setUp();
		$this->service = new ExternalPhotosAnalyzer($this->main_user);
	}

	function testTypeByDayOfWeek_Working()
	{
		$res = $this->service->analyze([$this->_createPhoto(null, strtotime('next Thursday'))]);
		$this->assertEqual('Working day', $res['type']);
	}

	function testTypeByDayOfWeek_Dayoff()
	{
		$res = $this->service->analyze([$this->_createPhoto(null, strtotime('next Sunday'))]);
		$this->assertEqual('Day off', $res['type']);
	}

	function testUserBirthday()
	{
		$this->main_user->birthday = date('1989-m-d');
		$this->main_user->save();
		$res = $this->service->analyze([$this->_createPhoto(null, time())]);
		$this->assertEqual($res['type'], Day::TYPE_HOLIDAY);
		$this->assertEqual($res['title'], 'My perfect birthday!');
	}

	function testEqualsMomentsTitle()
	{
		$res = $this->service->analyze([
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('foo bar'),
			$this->_createPhoto('bar foo')
		]);
		$this->assertEqual($res['title'], 'foo bar');
	}

	function _createPhoto($title = null, $time = null)
	{
		return (object) [
			'id' => 8511704824,
			'title' => $title,
			'time' => $time ? $time : time(),
			'image' => "http://farm9.staticflickr.com/8512/8511704824_82d8a6ddb2_b.jpg",
      'image_width' => 612,
      'image_height' => 612,
      'location_latitude' => null,
      'location_longitude' => null,
      'location_name' => null,
      'tags' => []
		];
	}
}