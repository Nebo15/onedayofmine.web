<?php
lmb_require('tests/cases/unit/odUnitTestCase.class.php');
lmb_require('src/service/social_photo_source/BasePhotoSource.class.php');

class BasePhotoSourceTest extends odUnitTestCase
{
	function testTestGetDays_NoPhotos()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 1);
		$mock->getDays($this->main_user);
	}

	function testTestGetDays_AllPhotosInOneQuerySecondIsEmpty_WithoutDays()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 100],
			['id' => 2, 'time' => 99],
		]);
		$mock->expectAt(1, 'getPhotos', [99]);
		$mock->returnsAt(1, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 2);
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(0, count($days));
	}

	function testTestGetDays_AllPhotosInOneQuerySecondIsEmpty_OneDays()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 1, 'time' => 100100],
			['id' => 2, 'time' => 10099],
			['id' => 3, 'time' => 10098],
			['id' => 4, 'time' => 200100],
			['id' => 5, 'time' => 20099],
			['id' => 6, 'time' => 20098],
		]);
		$mock->expectAt(1, 'getPhotos', [98]);
		$mock->returnsAt(1, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 2);
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(1, count($days));
	}

	function testTestGetDays_DayInTwoQueries()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 4, 'time' => 101000],
			['id' => 3, 'time' => 100999],
		]);
		$mock->expectAt(1, 'getPhotos', [100999]);
		$mock->returnsAt(1, 'getPhotos', [
			['id' => 2, 'time' => 100998],
			['id' => 1, 'time' => 1],
		]);
		$mock->expectAt(2, 'getPhotos', [1]);
		$mock->returnsAt(2, 'getPhotos', []);
		$mock->expectCallCount('getPhotos', 3);
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(1, count($days));
		$this->assertEqual(3, count($days[0]));
		$this->assertEqual(2, $days[0][0]['id']);
		$this->assertEqual(3, $days[0][1]['id']);
		$this->assertEqual(4, $days[0][2]['id']);
	}

	function testTestGetDays_AlmostCompleteDays()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
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
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(1, count($days));
		$this->assertEqual(4, count($days[0]));
		$this->assertEqual(7, $days[0][0]['id']);
		$this->assertEqual(6, $days[0][1]['id']);
		$this->assertEqual(5, $days[0][2]['id']);
		$this->assertEqual(4, $days[0][3]['id']);
	}

	function testTestGetDays_Minimum3DaysCount()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();

		$border_day_time = 1000000;

		$photos = [];
		for($i = 0; $i < 10; $i++)
			$photos[] = ['id' => $i, 'time' => 4000000 - $i];
		for(;$i < 20; $i++)
			$photos[] = ['id' => $i, 'time' => 3000000 - $i];
		for(;$i < 30; $i++)
			$photos[] = ['id' => $i, 'time' => 2000000 - $i];
		$mock->returnsAt(0, 'getPhotos', $photos);
		$mock->returnsAt(1, 'getPhotos', []);

		$mock->expectCallCount('getPhotos', 2);
		$days = $mock->getDays($this->main_user);

		for(;$i < 40; $i++)
			$photos[] = ['id' => $i, 'time' => 1000000 - $i];
		for(;$i < 50; $i++)
			$photos[] = ['id' => $i, 'time' => 9000000 - $i];
		$mock->returnsAt(2, 'getPhotos', $photos);

		$mock->expectCallCount('getPhotos', 3);
		$days = $mock->getDays($this->main_user);
	}

	function testTestGetDays_SkipExistedDays()
	{
		$day = $this->generator->day($this->main_user)->save();
		for($i = 0; $i < 10; $i++)
		{
			$moment = $this->generator->moment($day);
			$moment->time = 2309998 + $i;
			$moment->save();
		}

		$day = $this->generator->day($this->main_user)->save();
		for($i = 0; $i < 10; $i++)
		{
			$moment = $this->generator->moment($day);
			$moment->time = 1309998 + $i;
			$moment->save();
		}

		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();
		$mock->expectAt(0, 'getPhotos', [null]);
		$mock->returnsAt(0, 'getPhotos', [
			['id' => 50, 'time' => 2300000],

			['id' => 41, 'time' => 1301000],
			['id' => 42, 'time' => 1309999],
			['id' => 43, 'time' => 1309998],

			['id' => 30, 'time' => 301000],

			['id' => 11, 'time' => 101000],
			['id' => 12, 'time' => 100999],
			['id' => 13, 'time' => 100998],

			['id' => 1, 'time' => 1],
		]);
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(1, count($days));
		$this->assertEqual(13, $days[0][0]['id']);
	}

	/**
	 * @ticket #351
	 */
	function testTestGetDays_OneDayInDifferentGetPhotosAnswers()
	{
		Mock::generatePartial('BasePhotoSource', 'PhotoSourceMock', ['getPhotos']);
		$mock = new PhotoSourceMock();

		$border_day_time = 1000000;

		$photos = [];
		for($i = 0; $i < 10; $i++)
			$photos[] = ['id' => $i, 'time' => 4000000 - $i];
		for(;$i < 20; $i++)
			$photos[] = ['id' => $i, 'time' => 3000000 - $i];
		for(;$i < 30; $i++)
			$photos[] = ['id' => $i, 'time' => 2000000 - $i];
		for(;$i < 40; $i++)
			$photos[] = ['id' => $i, 'time' => $border_day_time - $i];
		$mock->returnsAt(0, 'getPhotos', $photos);

		$photos = [];
		for(;$i < 50; $i++)
			$photos[] = ['id' => $i, 'time' => $border_day_time - $i];
		for(;$i < 60; $i++)
			$photos[] = ['id' => $i, 'time' => 900000 - $i];
		for(;$i < 70; $i++)
			$photos[] = ['id' => $i, 'time' => 800000 - $i];
		for(;$i < 80; $i++)
			$photos[] = ['id' => $i, 'time' => 700000 - $i];
		$mock->returnsAt(1, 'getPhotos', $photos);

		$mock->expectCallCount('getPhotos', 1);
		$days = $mock->getDays($this->main_user);
		$this->assertEqual(3, count($days));
	}
}