<?php
lmb_require('limb/dbal/src/lmbSimpleDb.class.php');

class odTestsTools
{
  static function getUsers()
  {
    $users_file = lmb_var_dir().'/fb_test_users.txt';
    if(!file_exists($users_file))
    {
      $users_info = self::loadTestUsersFromFb();
      if(!$users_info)
      {
        echo "Can't load test users from Facebook".PHP_EOL;
        exit(1);
      }
      self::saveFbInfoToFile($users_info, $users_file);
    }

    $users_info = self::loadFbInfoFromFile($users_file);

    $users = array();
    foreach($users_info as $user_info)
    {
      $user = new User();
      $user->setFbUid($user_info['id']);
      $user->setFbAccessToken($user_info['access_token']);
      $users[] = $user;
    }
    return $users;
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

  protected static function loadTestUsersFromFb($attempts = 10)
  {
    echo "Try to load test users from fb (attempt remaining $attempts)...";
    $fb = lmbToolkit::instance()->getFacebook();
    if(!$attempts)
      throw new lmbException("Can't get facebook users");
    $params = array(
      'access_token' => $fb->getApplicationAccessToken()
    );
    $users = $fb->api("/".$fb->getAppId()."/accounts/test-users", "GET", $params);
    if(!count($users['data']))
      return self::loadTestUsersFromFb($attempts--);
    echo "SUCCESS!\n";
    return $users['data'];
  }

  protected static function saveFbInfoToFile($users_info, $file)
  {
    $fp = fopen($file, 'w');

    foreach($users_info as $user_info)
      fputcsv($fp, array($user_info['id'], $user_info['access_token']));

    fclose($fp);
  }

  protected static function loadFbInfoFromFile($file)
  {
    $users_info = array();
    if (($handle = fopen($file, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $users_info[] = array('id' => $data[0], 'access_token' => $data[1]);
      }
      fclose($handle);
    }
    return $users_info;
  }
}
