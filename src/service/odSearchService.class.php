<?php

class odSearchService extends SphinxClient
{
  protected static $config;

  public function __construct($config)
  {
    parent::__construct();

    lmb_assert_true(array_key_exists('host', $config));
    lmb_assert_true(array_key_exists('port', $config));
    $this->SetServer($config['host'], $config['port']);

    lmb_assert_true(array_key_exists('index', $config));

    if(array_key_exists('match_mode', $config))
      $this->SetMatchMode($config['match_mode']);

    if(array_key_exists('ranking_mode', $config))
      $this->SetRankingMode($config['ranking_mode'], null);

    if(array_key_exists('fields_weights', $config)) {
      lmb_assert_true(is_array($config['fields_weights']));

      $this->SetFieldWeights($config['fields_weights']);
    }

    self::$config = $config; // static coz PHP fails with SEGFAULT
  }

  public function find($query, $from_id = null, $to_id = null, $limit = null)
  {
    $result = $this->Query($query, self::$config['index']);
    if($result === false)
      lmbToolkit::instance()
        ->getLog()
        ->error("Sphinx query failed: ".$this->GetLastError());
    else
      if($this->GetLastWarning())
        lmbToolkit::instance()
        ->getLog()
        ->error("Sphinx query returned warning: ".$this->GetLastWarning());
      elseif(array_key_exists('matches', $result))
        return $result['matches'];

    return null;
  }
}
