<?php

class odFakeSearchService
{
	public $model_name;

	public function __construct($config) {}

	public function find($query, $from_id = null, $to_id = null, $limit = null)
	{
		$model_name = $this->model_name;
		$result = [];
		foreach($model_name::find() as $day)
			$result[] = $day->id;
		return $result;
	}

	public function applyLimitation(array $ids, $from_id = null, $to_id = null, $limit = null)
	{
	}
}
