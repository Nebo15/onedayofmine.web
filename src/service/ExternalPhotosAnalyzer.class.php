<?php

class ExternalPhotosAnalyzer
{
	protected $user;
	protected $type = [];
	protected $title = [];
	protected $description = [];

	function __construct(User $user)
	{
		$this->user = $user;
	}

	function analyze($moments)
	{
		$this->type = [];
		$this->title = [];
		$this->description = [];

		if(0 == count($moments))
			return ['type' => null, 'title' => null, 'description' => null];

		$moments = json_decode (json_encode ($moments), FALSE);

		$moments = $this->_cleanup($moments);

		$this->_checkDayOfWeek($moments);
		$this->_checkLocation($moments);
		$this->_checkHolidays($moments);
		$this->_checkLongestTitle($moments);
		$this->_checkBirthday($moments);

		$res = [];

		return [
			'type' => $this->_getWithMaxProbability($this->type),
			'title' => $this->_getWithMaxProbability($this->title),
			'description' => $this->_getWithMaxProbability($this->description)
		];
	}

	function addTitle($title, $probability)
	{
		$this->title[$title] = $probability;
	}

	function addType($type, $probability)
	{
		$this->type[$type] = $probability;
	}

	function addDescription($desc, $probability)
	{
		$this->description[$desc] = $probability;
	}

	protected function _cleanup($moments)
	{	
		foreach($moments as $i => $moment)
		{
			if($moment->title && substr_count($moment->title, '#') > 5)
				$moment->title = preg_replace( '/\#[a-z]+/i', '', $moment->title);

			foreach($moment->tags as $j => $tag)
			{
				if('insta' == substr($tag, 0, 5) || 'follow' == substr($tag, 0, 6) || 'like' == substr($tag, 0, 4))
					unset($moment->tags[$j]);
			}
			$moments[$i] = $moment;
		}
		return $moments;
	}

	protected function _checkDayOfWeek($moments)
	{
		$start_time = $moments[0]->time;
		$day_of_week = date('w', $start_time);

		if($day_of_week == 6 || $day_of_week == 0)
		{
			$this->addType('Day off', 20);
			$this->addTitle('My interest day off', 20);
		}
		else
		{
			$this->addType('Working day', 20);
			$this->addTitle('My interest work', 20);
		}
	}

	protected function _checkLocation($moments)
	{
		$locations = [];
		foreach($moments as $moment)
		{
			if(!isset($locations[$moment->location_name]))
				$locations[$moment->location_name] = 0;
			$locations[$moment->location_name]++;
		}
		if(!count($locations))
			return;
		asort($locations);
		if(array_values($locations)[0] >= count($moments) * 0.33)
			$this->addTitle(array_keys($locations)[0], 70);
	}

	protected function _checkHolidays($moments)
	{
		$holidays = [
			"Easter Sunday" => ["20090412", "20100404", "20120408", "20130331", "20140420", "20110424"],
			"Ash Wednesday" => ["20090225", "20100217", "20120222", "20130213", "20140305", "20110309"],
			"Palm Sunday" => ["20090405", "20100328", "20120401", "20130324", "20140413", "20110417"],
			"Good Friday" => ["20090410", "20100402", "20120406", "20130329", "20140418", "20110422"],
			"Pentecost" => ["20090531", "20100523", "20120527", "20130519", "20140608", "20110612"],
			"Trinity Sunday" => ["20090607", "20100530", "20120603", "20130526", "20140615", "20110619"],
			"Ascension Day" => ["20090521", "20100513", "20120517", "20130509", "20140529", "20110602"],
			"New Year's Day" => ["20100101", "20101231", "20120102", "20130101", "20140101"],
			"Birthday of Martin Luther King" => ["20100118", "20110117", "20120116", "20130121", "20140120"],
			"Washington's Birthday" => ["20100215", "20110221", "20120220", "20130218", "20140217"],
			"Memorial Day" => ["20100531", "20110530", "20120528", "20130527", "20140526"],
			"Independence Day" => ["20100705", "20110704", "20120704", "20130704", "20140704"],
			"Labor Day" => ["20100906", "20110905", "20120903", "20130902", "20140901"],
			"Columbus Day" => ["20101011", "20111010", "20121008", "20131014", "20141013"],
			"Veterans Day" => ["20101111", "20111111", "20121112", "20131111", "20141111"],
			"Thanksgiving Day" => ["20101125", "20111124", "20121122", "20131128", "20141127"],
			"Christmas Day" => ["20101224", "20111226", "20121225", "20131225", "20141225"],
		];

		$date = date('Ymd', $moments[0]->time);
		foreach($holidays as $name => $dates)
		{
			if(false !== array_search($date, $dates))
			{
				$this->addType('Holiday',90);
				$this->addTitle($name,90);
				break;
			}
		}
	}

	protected function _checkLongestTitle($moments)
	{
		$desc = '';
		foreach($moments as $moment)
		{
			if($moment->title && strlen($desc) < $moment->title)
				$desc = $moment->title;
		}
		$this->addDescription($desc, 10);
	}

	protected function _checkBirthday($moments)
	{
		if(!$this->user->birthday)
			return;

		list($birthday_year, $birthday_month, $birthday_day) = explode('-', $this->user->birthday);
		$day_stamp = $moments[0]->time;
		$day_year = date('Y', $day_stamp);
		$birthday_stamp = strtotime($day_year.'-'.$birthday_month.'-'.$birthday_day);
		$delta = ($birthday_stamp - $day_stamp) / 24 / 60 / 60;
		if($delta > -2 && $delta < 4)
		{
			$this->addType(Day::TYPE_HOLIDAY, 99);
			$this->addTitle('My perfect birthday!', 99);
		}
	}

	protected function _getWithMaxProbability($values)
	{
		$current_probability = 0;
		$res = null;
		foreach($values as $value => $probability)
		{
			if($probability > $current_probability)
			{
				$res = $value;
				$current_probability = $probability;
			}
		}
		return $res;
	}
}