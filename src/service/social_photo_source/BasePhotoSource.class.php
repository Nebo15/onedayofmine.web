<?php

abstract class BasePhotoSource
{
	abstract function getPhotos($from_stamp = null, $to_stamp = null);

	function getDays(User $filter_by_user , $from_stamp = null)
	{
		$days = [];
		$photos = true;
		while (count($days) < 4)
		{
			if (!$photos = $this->getPhotos($from_stamp))
				break;
			$days = $this->_attachDays($days, $photos);
			$last_photo_time = $photos[count($photos) - 1]['time'];
			if($from_stamp != $last_photo_time)
				$from_stamp = $last_photo_time;
		}

		if (!count($days))
			return [];

		array_pop($days);

		foreach($days as $i => $day)
			$days[$i] = array_reverse($day);

		if($filter_by_user)
			$days = $this->_dropExistentDays($days, $filter_by_user);

		return array_values($days);
	}

	protected function _attachDays($days, $photos)
	{
		foreach ($photos as $photo)
		{
			if (!count($days))
			{
				$days[] = [array_shift($photos)];
				continue;
			}
			$current_day_pos = count($days) - 1;
			$prev_photo_pos = count($days[$current_day_pos]) - 1;
			if (($days[$current_day_pos][$prev_photo_pos]['time'] -
					$photo['time']) < 4 * 60 * 60)
			{
				$days[$current_day_pos][] = $photo;
			}
			else
			{
				if (count($days[$current_day_pos]) < 3)
					$days[$current_day_pos] = [$photo];
				else
					$days[] = [$photo];
			}
		}
		return $days;
	}

	protected function _dropExistentDays($days, User $user)
	{
		$day_begins = $user->getDaysBeginTime();
		foreach($days as $i => $day)
			foreach($day_begins as $day_begin)
				if(date('Y.m.d', $day[0]['time']) === date('Y.m.d', $day_begin['time']))
					unset($days[$i]);
		return $days;
	}
}