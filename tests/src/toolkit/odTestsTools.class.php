<?php
lmb_require('tests/src/odObjectMother.class.php');
lmb_require('tests/src/odPostmanWriter.class.php');
lmb_require('tests/src/odApiToMarkdownWriter.class.php');
lmb_require('tests/src/odModelToEntitiesWriter.class.php');

class odTestsTools extends lmbAbstractTools
{
  /**
   * @var odPostmanWriter
   */
  protected $postman_writer;

  /**
   * @var odApiToMarkDownWriter
   */
  protected $api_to_markdown_writer;

  /**
   * @var odModelToEntitiesWriter
   */
  protected $model_to_entities_writer;

  /**
   * @return odPostmanWriter
   */
  function getPostmanWriter()
  {
    if(!$this->postman_writer)
      $this->postman_writer = new odPostmanWriter(lmb_env_get('APP_DIR').'/www/api_doc/postman.json');
    return $this->postman_writer;
  }

  /**
   * @return odApiToMarkDownWriter
   */
  function getApiToMarkdownWriter()
  {
    if(!$this->api_to_markdown_writer)
      $this->api_to_markdown_writer = new odApiToMarkdownWriter(lmb_env_get('APP_DIR').'/www/api_doc/examples.markdown');
    return $this->api_to_markdown_writer;
  }

  /**
   * @return odModelToEntitiesWriter
   */
  function getModelToEntitiesWriter() {
    if(!$this->model_to_entities_writer)
      $this->model_to_entities_writer = new odModelToEntitiesWriter(lmb_env_get('APP_DIR').'/www/api_doc/entities.markdown');
    return $this->model_to_entities_writer;
  }

  function getTestsUsers($all = false)
  {
    $fb_test_users = lmbToolkit::instance()->loadTestsUsersInfo();
    if($all)
      $users_infos = $fb_test_users;
    else
      $users_infos = array(array_pop($fb_test_users), array_pop($fb_test_users));

    if(!count($users_infos))
    {
      echo "Can't load users from fb";
      exit(1);
    }

    $users = array();
    foreach($users_infos as $key => $user_info)
    {
      $user_info = (object) $user_info;
      $user = new User();
      $user->setFbUid($user_info->id);
      $user->setFbAccessToken($user_info->access_token);
      $user->import((new FacebookProfile($user))->getInfo());

      $settings = $user->getSettings();
      $settings->setSocialShareFacebook(1);
      $settings->setSocialShareTwitter(1);
      $user->setSettings($settings);

      $twitter_credentials = (new odObjectMother())->twitter_credentials()[$key % 2];
      $user->setTwitterUid($twitter_credentials['uid']);
      $user->setTwitterAccessToken($twitter_credentials['access_token']);
      $user->setTwitterAccessTokenSecret($twitter_credentials['access_token_secret']);
      $users[] = $user;
    }
    return $users;
  }

  static function truncateTablesOf($model_classes)
  {
    if(!is_array($model_classes))
      $model_classes = func_get_args();
    foreach($model_classes as $model_class)
    {
      $model_class::delete();
    }
  }

  function checkServer($uri_string)
  {
    $uri = new lmbUri($uri_string);
    $fp = @fsockopen($uri->getHost(), $uri->getPort() ?: 80, $errno, $errstr, 30);
    if (!$fp) {
      echo("Can't connect to server '$uri_string': $errstr ($errno)\n");
      exit(1);
    } else {
      fclose($fp);
    }
  }
}


