<?php

abstract class BasePhotoSource
{
	abstract function getPhotos($from_stamp = null, $to_stamp = null);

	function getDays(User $filter_by_user , $from_stamp = null)
	{
		$days = [];
		$photos = true;
		while (count($days) < 3)
		{
			if (!$photos = $this->getPhotos($from_stamp))
				break;
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
			if($from_stamp == $photo['time'])
				break;
			$from_stamp = $photo['time'];
		}

		if ($days && count($days[count($days) - 1]) < 3)
			array_pop($days);


		foreach($days as $i => $day)
			$days[$i] = array_reverse($day);

		if($filter_by_user)
		{
			$day_begins = $filter_by_user->getDaysBeginTime();
			foreach($days as $i => $day)
				foreach($day_begins as $day_begin)
					if(date('Y.m.d', $day[0]['time']) === date('Y.m.d', $day_begin['time']))
						unset($days[$i]);
		}

		return array_values($days);
	}
}