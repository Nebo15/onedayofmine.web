<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/social_photo_source/BaseSocialPhotoSource.class.php');

class BaseSocialPhotoSourceTest extends odUnitTestCase
{
	function testTestGetDays_NoPhotos()
	{
		Mock::generatePartial('SocialPhotoSourceForTests', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 1);
		$mock->getDays();
	}

	function testTestGetDays_AllPhotosInOneQuerySecondIsEmpty_WithoutDays()
	{
		Mock::generatePartial('SocialPhotoSourceForTests', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 100],
			['id' => 2, 'time' => 99],
		]);
		$mock->expectAt(1, 'getPhotos', [99]);
		$mock->returnsAt(1, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 2);
		$days = $mock->getDays();
		$this->assertEqual(0, count($days));
	}

	function testTestGetDays_AllPhotosInOneQuerySecondIsEmpty_OneDays()
	{
		Mock::generatePartial('SocialPhotoSourceForTests', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 100],
			['id' => 2, 'time' => 99],
			['id' => 3, 'time' => 98],
		]);
		$mock->expectAt(1, 'getPhotos', [98]);
		$mock->returnsAt(1, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 2);
		$days = $mock->getDays();
		$this->assertEqual(1, count($days));
	}

	function testTestGetDays_DayInTwoQueries()
	{
		Mock::generatePartial('SocialPhotoSourceForTests', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 101000],
			['id' => 2, 'time' => 100999],
		]);
		$mock->expectAt(1, 'getPhotos', [100999]);
		$mock->returnsAt(1, 'getPhotos', [
			['id' => 3, 'time' => 100998],
			['id' => 4, 'time' => 1],
		]);
		$mock->expectAt(2, 'getPhotos', [1]);
		$mock->returnsAt(2, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 3);
		$days = $mock->getDays();
		$this->assertEqual(1, count($days));
		$this->assertEqual(3, count($days[0]));
		$this->assertEqual(1, $days[0][0]['id']);
		$this->assertEqual(2, $days[0][1]['id']);
		$this->assertEqual(3, $days[0][2]['id']);
	}

	function testTestGetDays_AlmostCompleteDays()
	{
		Mock::generatePartial('SocialPhotoSourceForTests', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 301000],
			['id' => 2, 'time' => 201000],
			['id' => 3, 'time' => 200999],
			['id' => 4, 'time' => 101000],
			['id' => 5, 'time' => 100999],
		]);
		$mock->expectAt(1, 'getPhotos', [100999]);
		$mock->returnsAt(1, 'getPhotos', [
			['id' => 6, 'time' => 100998],
			['id' => 7, 'time' => 100997],
			['id' => 8, 'time' => 1],
		]);
		$mock->expectAt(2, 'getPhotos', [1]);
		$mock->returnsAt(2, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 3);
		$days = $mock->getDays();
		$this->assertEqual(1, count($days));
		$this->assertEqual(4, count($days[0]));
		$this->assertEqual(4, $days[0][0]['id']);
		$this->assertEqual(5, $days[0][1]['id']);
		$this->assertEqual(6, $days[0][2]['id']);
		$this->assertEqual(7, $days[0][3]['id']);
	}
}

class SocialPhotoSourceForTests extends BaseSocialPhotoSource
{
	protected function getConfig() {}
	function getLoginUrl($redirect_url) {}
	function login($code, $redirect_url) {}
	function getUserInfo() {}
	function getPhotos($from_stamp = null, $to_stamp = null) {}
	function logout() {}
}