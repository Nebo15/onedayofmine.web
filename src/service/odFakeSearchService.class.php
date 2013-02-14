<?php

class odFakeSearchService
{
	public function __construct($config) {}

	public function find($query, $from_id = null, $to_id = null, $limit = null)
	{
		$result = [];
		foreach(Day::findNew($from_id, $to_id, $limit) as $day)
			$result[] = $day->id;
		return $result;
	}

	public function applyLimitation(array $ids, $from_id = null, $to_id = null, $limit = null)
	{
	}
}
