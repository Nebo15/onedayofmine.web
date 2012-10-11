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
      $this->SetRankingMode($config['ranking_mode']);

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
        return $this->applyLimitation(array_keys($result['matches']), $from_id, $to_id, $limit);

    return null;
  }

  public function applyLimitation(array $ids, $from_id = null, $to_id = null, $limit = null)
  {
    $limit = abs($limit);
    $limit = (!$limit || $limit > 100) ? 100 : $limit;

    $result = [];
    $stated = ! (bool) $from_id;
    foreach ($ids as $id)
    {
      if($id == $to_id)
        break;

      if($stated)
      {
        if($limit < 1)
          break;
        else
          $limit--;

        $result[] = $id;
      }
      elseif($id == $from_id)
        $stated = true;
    }

    return $result;
  }
}
