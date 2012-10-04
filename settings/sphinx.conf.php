<?php

$conf = [
  'host' => 'localhost',
  'port' => 3312,

  'users' => [
    'match_mode'   => SPH_MATCH_EXTENDED2,
    'ranking_mode' => SPH_RANK_PROXIMITY_BM25,
    'index'        => 'users',
  ],

  'days' => [
    'match_mode'     => SPH_MATCH_ANY,
    'ranking_mode'   => SPH_RANK_PROXIMITY_BM25,
    'fields_weights' => [
      'name' => 1,
    ],
    'index'          => 'days',
  ],
];
