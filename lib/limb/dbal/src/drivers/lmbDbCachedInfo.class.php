<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */
lmb_require('limb/core/src/lmbSerializable.class.php');
lmb_require('limb/core/src/lmbProxy.class.php');
lmb_require('limb/fs/src/lmbFs.class.php');

/**
 * class lmbDbCachedInfo.
 *
 * @package dbal
 * @version $Id: lmbDbCachedInfo.class.php 8051 2010-01-19 22:39:25Z korchasa $
 */
class lmbDbCachedInfo extends lmbProxy
{
  const CACHE_KEY = 'db_info';

  protected $conn;
  protected $db_info;
  /**
   * @var lmbCacheAbstractConnection
   */
  protected $cache;

  function __construct(lmbDbConnection $conn, $cache)
  {
    $this->conn = $conn;
    $this->cache = $cache;
  }

  function flushCache()
  {
    $this->cache->delete(self::CACHE_KEY);
  }

  protected function _createOriginalObject()
  {
    if($db_info = $this->_readFromCache())
      return $db_info;

    //forcing to load all metainfo
    $db_info = $this->conn->getDatabaseInfo();
    $tables = $db_info->getTableList();
    foreach($tables as $table)
      $db_info->getTable($table)->loadColumns();

    $this->_writeToCache($db_info);
    return $db_info;
  }

  protected function _readFromCache()
  {
    $container = unserialize($this->cache->get(self::CACHE_KEY));
    $db_info = $container->getSubject();
    return $db_info;
  }

  protected function _writeToCache($db_info)
  {
    $this->cache->set(self::CACHE_KEY, serialize(new lmbSerializable($db_info)));
  }
}


