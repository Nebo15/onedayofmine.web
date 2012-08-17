<?php
lmb_require('src/service/social_profile/SharesInterface.class.php');

class odPostingService implements SharesInterface
{
  /**
   * @throws lmbException
   */
  protected function share($name, $args)
  {
    static $facebook_profile;
    static $twitter_profile;

    $user = lmbToolkit::instance()->getUser();
    lmb_assert_true($user, 'User is not set!');
    $settings = $user->getSettings();

    // Facebook
    if($settings->getSocialShareFacebook())
      if($user->getFbAccessToken()) {
        $facebook_profile = $facebook_profile ?: new FacebookProfile($user);

        if(!call_user_func_array(array($facebook_profile, $name), $args))
          throw new lmbException("Can't share with Facebook.", array('function_name' => $name, 'function_args' => $args));
      }
      else
        lmbToolkit::instance()->log()->warning('Facebook sharing is on, while facebook token is empty.', array(
          'user_id'             => $user->getId(),
          'access_token'        => $user->getFbAccessToken(),
        ));

    // Twitter
    if($settings->getSocialShareTwitter())
      if($user->getTwitterAccessToken() && $user->getTwitterAccessTokenSecret()) {
        $twitter_profile = $twitter_profile ?: new TwitterProfile($user);

        if(!call_user_func_array(array($twitter_profile, $name), $args))
          throw new lmbException("Can't share with Twitter.", array('function_name' => $name, 'function_args' => $args));
      }
      else
        lmbToolkit::instance()->log()->warning('Twitter sharing is on, while twitter is not connected.', array(
          'user_id'             => $user->getId(),
          'access_token'        => $user->getTwitterAccessToken(),
          'access_token_secret' => $user->getTwitterAccessTokenSecret(),
        ));
  }

  public function shareDayBegin(Day $day)
  {
    $this->share('shareDayBegin', func_get_args());
  }

  public function shareDay(Day $day)
  {
    $this->share('shareDay', func_get_args());
  }

  public function shareDayLike(Day $day)
  {
    $this->share('shareDayLike', func_get_args());
  }

  public function shareMomentAdd(Day $day, Moment $moment)
  {
    $this->share('shareMomentAdd', func_get_args());
  }

  public function shareMomentLike(Moment $moment)
  {
    $this->share('shareMomentLike', func_get_args());
  }

  public function shareDayEnd(Day $day)
  {
    $this->share('shareDayEnd', func_get_args());
  }
}
