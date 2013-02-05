<?php

/*
 * @todo Дергать расписание в концертных залах
 */
class InstagramPhotosAnalyzer
{
	protected $moments = [];
	protected $type = 'Working day';
	protected $title;
	protected $description;

	function __construct($moments)
	{
		$this->moments = json_decode (json_encode ($moments), FALSE);
	}

	function analyze()
	{
		setlocale(LC_ALL, 'en_US');

		$day = $this->_cleanup();

		$moments_count = count($day);

		$start_time = $this->moments[0]->created_time;
		$day_of_week = date('w', $start_time);

		if($day_of_week == 6 || $day_of_week == 0)
			$this->type = 'Day off';

		if(!$this->title && $this->type == 'Day off')
			$this->title = 'My interest day off';

		$this->_checkLocation();

		$this->_checkHolidays();

		foreach($this->moments as $moment)
		{
			if(!$this->description && $moment->caption)
				$this->description = $moment->caption->text;
			if($moment->caption && strlen($this->description) < $moment->caption->text)
				$this->description = $moment->caption->text;
		}

//		foreach($this->moments as $moment)
//		{
//			echo "Time: ".$moment->created_time.PHP_EOL;
//			if($moment->caption)
//				echo "Caption: ".$moment->caption->text.PHP_EOL;
//			echo "Link: ".$moment->link.PHP_EOL;
//			if($moment->location && property_exists($moment->location, 'name'))
//				echo "Location: ".$moment->location->name.PHP_EOL;
//			echo "Tags: ".implode(' ', $moment->tags).PHP_EOL;
//			echo str_repeat('-', 80).PHP_EOL;
//		}
//		echo 'magic: '.$this->type.' / '.$this->title.' / '.$this->description.PHP_EOL;
//		echo str_repeat('=',80).PHP_EOL.PHP_EOL;

		return (object) [
			'type' => $this->type,
			'title' => $this->title,
			'description' => $this->description
		];
	}

	function _cleanup()
	{
		foreach($this->moments as $i => $moment)
		{
			if($moment->caption && substr_count($moment->caption->text, '#') > 5)
				$moment->caption->text = preg_replace( '/\#[a-z]+/i', '', $moment->caption->text);

			if(!isset($moment->tags))
				$moment->tags = [];
			foreach($moment->tags as $j => $tag)
			{
				if('insta' == substr($tag, 0, 5) || 'follow' == substr($tag, 0, 6) || 'like' == substr($tag, 0, 4))
					unset($moment->tags[$j]);
			}
			$this->moments[$i] = $moment;
		}
	}

	function _checkLocation()
	{
		$locations = [];
		foreach($this->moments as $moment)
		{
			if(!$moment->location || !property_exists($moment->location, 'name')) continue;
			if(!isset($locations[$moment->location->name]))
				$locations[$moment->location->name] = 0;
			$locations[$moment->location->name]++;
		}
		if(!count($locations))
			return;
		asort($locations);
		if(array_values($locations)[0] >= count($this->moments) * 0.33)
			$this->title = array_keys($locations)[0];
	}

	function _checkHolidays()
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

		$date = date('Ymd', $this->moments[0]->created_time);
		foreach($holidays as $name => $dates)
		{
			if(false !== array_search($date, $dates))
			{
				$this->type = 'Holiday';
				$this->title = $name;
				break;
			}
		}
	}
}