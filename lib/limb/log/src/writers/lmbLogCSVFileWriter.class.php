<?php
lmb_require('limb/fs/src/lmbFs.class.php');
lmb_require('limb/log/src/writers/lmbLogBaseWriter.class.php');
lmb_require('limb/core/src/lmbArrayHelper.class.php');

/**
 * class lmbLogCSVWriter.
 *
 * @package log
 */
class lmbLogCSVFileWriter extends lmbLogBaseWriter
{
  protected $log_file;

  function __construct(lmbUri $dsn)
  {
    $this->log_file = $dsn->getPath();
    parent::__construct($dsn);
  }

  protected function _write(lmbLogEntry $entry)
  {
    $file_name = $this->getLogFile();
    lmbFs::mkdir(dirname($file_name), 0775);
    $file_existed = file_exists($file_name);

    if($fh = fopen($file_name, 'a'))
    {
      @flock($fh, LOCK_EX);

      $params = [];
      lmbArrayHelper::toFlatArray($entry->getParams(), $params);

      $log_entrys = [];
      $log_entrys[] = strftime("%b %d %Y %H:%M:%S", $entry->getTime());

      foreach ($params as $key => $value) {
        $tmp = preg_replace('#[\s]{2,}#is', ' ', $value);
        $tmp = preg_replace('#image_content=[^&]*#is', 'image_conents=[img]', $tmp);
        if($tmp)
          $log_entrys[] = $tmp;
      }

      fwrite($fh, implode(';', $log_entrys).PHP_EOL);
      @flock($fh, LOCK_UN);
      fclose($fh);
      if(!$file_existed)
        chmod($file_name, 0664);
    }
    else
    {
      throw new lmbFsException("Cannot open log file '$file_name' for writing" . PHP_EOL .
                               "The web server must be allowed to modify the file." . PHP_EOL .
                               "File logging for '$file_name' is disabled.");
    }
  }

  function getLogFile()
  {
    return $this->log_file;
  }
}
