<?php
lmb_require('limb/dbal/src/lmbSimpleDb.class.php');

class odTestsTools
{
  static function getUsers()
  {
    $users_file = lmb_var_dir().'/fb_test_users.txt';
    if(!file_exists($users_file))
    {
      $users_info = lmbToolkit::instance()->getFacebook()->getTestUsers();
      if(!$users_info)
      {
        echo "Can't load test users from Facebook".PHP_EOL;
        exit(1);
      }
      file_put_contents($users_file, serialize($users_info));
    }

    $users_info = unserialize(file_get_contents($users_file));

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
}
