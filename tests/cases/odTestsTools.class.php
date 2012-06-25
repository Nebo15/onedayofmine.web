<?php
lmb_require('limb/dbal/src/lmbSimpleDb.class.php');

class odTestsTools
{
  static function getUsers()
  {
    $users_info = self::loadUsersInfo();
    return self::mapUsersInfoToModel($users_info);
  }

  static function loadUsersInfo()
  {
    $users_file = lmb_env_get('APP_DIR').'/var/fb_test_users.json';
    if(!file_exists($users_file))
    {
      echo "Try to load test users from fb...\n";
      $users_info = self::loadTestUsersFromFb();
      if(!$users_info)
      {
        echo "Can't load test users from Facebook".PHP_EOL;
        exit(1);
      }
      self::saveFbInfoToFile($users_info, $users_file);
    }
    else
    {
      $users_info = self::loadFbInfoFromFile($users_file);
      $is_users_info_valid = self::checkAccessTokensExpiration($users_info);
      if(!$is_users_info_valid)
      {
        unlink($users_file);
        return self::getUsers();
      }
    }
    return $users_info;
  }

  protected static function loadTestUsersFromFb()
  {
    $fb = lmbToolkit::instance()->getFacebook();
    $params = array(
      'access_token' => $fb->getApplicationAccessToken()
    );
    $users = $fb->api("/".$fb->getAppId()."/accounts/test-users", "GET", $params);
    return $users['data'];
  }

  static function truncateTablesOf($model_classes)
  {
    if(!is_array($model_classes))
      $model_classes = func_get_args();
    $db = new lmbSimpleDb(lmbToolkit::instance()->getDefaultDbConnection());
    foreach($model_classes as $model_class)
    {
      $model = new $model_class;
      $db->truncateTable($model->getTableName());
    }
  }

  static function checkServer($uri_string)
  {
    $uri = new lmbUri($uri_string);
    @$fp = fsockopen($uri->getHost(), $uri->getPort() ?: 80, $errno, $errstr, 30);
    if (!$fp) {
      echo("Can't connect to server '$uri_string': $errstr ($errno)\n");
      exit(1);
    } else {
      fclose($fp);
    }
  }

  protected static function checkAccessTokensExpiration($users_info)
  {
    static $is_checked = true;
    if($is_checked)
      return true;
    foreach($users_info as $user_info)
    {
      $fb = lmbToolkit::instance()->getFacebook($user_info->access_token);
      try {
        $fb->api('/me');
      }
      catch(FacebookApiException $e)
      {
        if(0 === strpos($e->getMessage(), "Session has expired at unix time"))
          return false;
        echo $e->getType().': '.$e->getMessage().PHP_EOL;
      }
    }
    $is_checked = true;
    return true;
  }

  protected static function saveFbInfoToFile($users_info, $file)
  {
    lmbFs::safeWrite($file, Json::indent(json_encode($users_info)));
  }

  protected static function loadFbInfoFromFile($file)
  {
    return json_decode(file_get_contents($file));
  }

  protected static function mapUsersInfoToModel($users_info)
  {
    $users = array();
    foreach($users_info as $user_info)
    {
      $user_info = (object) $user_info;
      $user = new User();
      $user->setFbUid($user_info->id);
      $user->setFbAccessToken($user_info->access_token);
      $users[] = $user;
    }
    return $users;
  }
}
