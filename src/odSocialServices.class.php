<?php
lmb_require('tests/src/service/odRemoteApiMock.class.php');

/**
 * Implements same interface as users to allow batch pocessing.
 */
class odSocialServices
{
  const PROVIDER_FACEBOOK = 'Facebook';
  const PROVIDER_TWITTER  = 'Twitter';
  const PROVIDER_MULTI    = 'Multi';

  /**
   * Create odTwitter instance with or without auth.
   *
   * @param  string $access_token
   * @param  string $access_token_secret
   * @return odTwitter
   */
  public function getTwitter($access_token = null, $access_token_secret = null)
  {
    static $twitter_instances = array();

    if(!array_key_exists($access_token, $twitter_instances)) {
      $config = odTwitter::getConfig();

      if(!is_null($access_token) && !is_null($access_token_secret)) {
        $config['user_token']  = $access_token;
        $config['user_secret'] = $access_token_secret;
      }

      $twitter_instances[$access_token] = new odTwitter($config);

      if(lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled)
        $twitter_instances[$access_token] = new odRemoteApiMock(
          $twitter_instances[$access_token],
          lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/twitter_cache/'.$access_token)
        );

    }

    return $twitter_instances[$access_token];
  }

  /**
   * Create odFacebook instance with or without auth.
   *
   * @param  string $access_token
   * @return odFacebook
   */
  public function getFacebook($access_token = null)
  {
    static $facebook_instances = array();

    if(!array_key_exists($access_token, $facebook_instances)) {
      // NOTICE: connection can be cached
      $instance = new odFacebook(odFacebook::getConfig());

      if(!is_null($access_token))
        $instance->setAccessToken($access_token);

      if(lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled)
        $facebook_instances[$access_token] = new odRemoteApiMock(
          $instance,
          lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/facebook_cache/'.$access_token)
        );
      else
        $facebook_instances[$access_token] = $instance;
    }

    return $facebook_instances[$access_token];
  }

  /**
   * Returns user connected with single social service or few of them.
   *
   * @param  User   $user     [description]
   * @param  string $provider See {@see odSocialServices::PROVIDER_*} constants.
   * @return odSocialServiceUserInterface
   */
  public function getSocialProfile(User $user, $provider = self::PROVIDER_MULTI) // add mocks
  {
    // Future idea
    // strpos(|, provider); foreach(explode('|', $provider) ...) $providers_pull = ...;

    switch ($provider) {
      case self::PROVIDER_FACEBOOK:
        lmb_assert_true($user->getFbAccessToken(), 'Facebook access token not specified.');
        $profile = new FacebookProfile($user);
        break;

      case self::PROVIDER_TWITTER:
        lmb_assert_true($user->getTwitterAccessToken(), 'Twitter access token not specified.');
        lmb_assert_true($user->getTwitterAccessTokenSecret(), 'Twitter access token secret not specified.');
        $profile = new TwitterProfile($user);
        break;

      default:
        $providers = array();
        // Facebook is must-have provider
        $providers[self::PROVIDER_FACEBOOK] = $this->getSocialProfile($user, self::PROVIDER_FACEBOOK);

        if($user->getTwitterAccessToken() && $user->getTwitterAccessTokenSecret())
          $providers[self::PROVIDER_TWITTER]  = $this->getSocialProfile($user, self::PROVIDER_TWITTER);

        lmb_assert_true(count($providers));
        $profile = new MultiproviderUser($user, $providers);
        break;
    }
    return $profile;
  }

  // public function combineProviders(polymorphic); implode(|)
  // public function decombineProviders(); explode(|)
}
