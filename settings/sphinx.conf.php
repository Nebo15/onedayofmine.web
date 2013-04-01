<?php

$conf = [
	'enabled' => true,
  'host'  => 'localhost',
  'port'  => 3312,

  'User' => [
    'match_mode'     => SPH_MATCH_EXTENDED2,
    'ranking_mode'   => SPH_RANK_PROXIMITY_BM25,
    'index'          => 'users',
  ],

  'Day'  => [
    'match_mode'     => SPH_MATCH_EXTENDED2,
    'ranking_mode'   => SPH_RANK_PROXIMITY_BM25,
    'index'          => 'days',
    'fields_weights' => [
      'title'             => 10,
      'final_description' => 1,
      'keywords'          => 1,
    ],
  ],
];
