<?php

require_once('limb/core/common.inc.php');

class lmbBundler
{
  static public $regexp_for_requires = '/^\s*((lmb_)?require(_once)?)\s*\(?[\'|\"]([a-zA-z0-9\-_.\/]+).*$/m';
  static public $regexp_for_package_requires = '/^\s*(lmb_package_require)\s*\([\'|\"]([a-zA-z0-9\-_.\/]+).*$/m';
  public $include_paths;
  protected $_includes = array();
  protected $_verbose;

  function __construct($include_path, $verbose = false)
  {
    $this->include_paths = explode(PATH_SEPARATOR, $include_path);
    foreach($this->include_paths as $key => $path)
    {
      if(!strlen($path))
      unset($this->include_paths[$key]);
    }

    $this->_verbose = $verbose;
  }

  static function getDependenciesFromFileSource($file_content)
  {
    $file_content = trim($file_content);
    $deps = array();
    $files = array();

    preg_match_all(self::$regexp_for_requires, $file_content, $files);
    if(isset($files[4]))
      $deps = array_merge($deps, $files[4]);

    preg_match_all(self::$regexp_for_package_requires, $file_content, $files);
    if(isset($files[2]))
      foreach($files[2] as $dep_file)
        $deps[] = 'limb/'.$dep_file.'/common.inc.php';

    return $deps;
  }

  function resolvePath($file)
  {
    if($this->isPathAbsolute($file))
      return $file;

    $file_path = false;
    foreach($this->include_paths as $include_path)
    {
      $full_path = $include_path . '/' . $file;

      if(file_exists($full_path)) {
        return realpath($full_path);
      }
    }

    return $file_path;
  }

  function isPathAbsolute($path)
  {
    return lmb_is_path_absolute($path);
  }

  function add($file)
  {
    $resolved_file = $this->resolvePath(trim($file));
    if(!$resolved_file)
    {
      die('File not found: '.$file.PHP_EOL);
    }

    if(in_array($resolved_file, $this->_includes))
    {
      if($this->_verbose)
        echo 'exist: '.$resolved_file.PHP_EOL;
      return;
    }

    if($this->_verbose)
      echo 'add: '.$resolved_file.PHP_EOL;

    $deps = self::getDependenciesFromFileSource(file_get_contents($resolved_file));

    foreach($deps as $dependency)
    {
      $dependency_path = $this->resolvePath($dependency);

      if(in_array($dependency_path, $this->_includes))
        continue;

      if($this->_verbose)
        echo 'dependency: '.$dependency_path.' ('.$dependency.')'.PHP_EOL;

      $this->add($dependency_path);
    }

    if($this->_verbose)
      echo 'pushed: '.$resolved_file.PHP_EOL;

    if(!in_array($resolved_file, $this->_includes))
      $this->_includes[] = $resolved_file;
  }

  function getIncludes($path_prefix = null)
  {
    if(!$path_prefix)
      return $this->_includes;

    $result = array();
    foreach($this->_includes as $include)
    {
      if(0 === strpos($include, $path_prefix))
        $result[] = $include;
      elseif($this->_verbose)
        echo 'excluded: '.$include.PHP_EOL;
    }
    return $result;
  }

  static function cleanUpFile($file)
  {
    if(is_dir($file))
      return;

    $fileStr = file_get_contents($file);
    $fileStr = preg_replace(self::$regexp_for_requires, '', $fileStr);

    $newStr  = '';
    $tokens = token_get_all($fileStr);
    foreach ($tokens as $token)
    {
      if (is_array($token))
      {
        $type = $token[0];
        if ($type == T_DOC_COMMENT || $type == T_COMMENT || $type == T_OPEN_TAG || $type == T_CLOSE_TAG)
          continue;

        $token = $token[1];
      }
      $newStr .= $token;
    }

    while(false !== strpos($newStr, PHP_EOL.PHP_EOL.PHP_EOL))
      $newStr = str_replace(PHP_EOL.PHP_EOL.PHP_EOL, PHP_EOL.PHP_EOL, $newStr);

    return $newStr;
  }

  function makeBundle($without_tags = false, $include_dir = null)
  {
    $result = $without_tags ? '' : "<?php\n";
    foreach(array_unique($this->getIncludes($include_dir)) as $file)
    {
      $result .= self::cleanUpFile($file);
    }
    return $result;
  }
}
