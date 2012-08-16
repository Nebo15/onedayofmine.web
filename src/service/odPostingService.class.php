<?php
lmb_require('src/service/social_profile/SharesInterface.class.php');

class odPostingService implements SharesInterface
{
  protected $twitter_profile;
  protected $facebook_profile;

  public function __construct()
  {
    $user                   = lmbToolkit::instance()->getUser();
    $this->facebook_profile = new FacebookProfile($user);
    $this->twitter_profile  = new TwitterProfile($user);
  }

  /**
   * @throws lmbException
   */
  protected function share($name, $args)
  {
    $user     = lmbToolkit::instance()->getUser();
    $settings = $user->getSettings();

    if($settings->getSocialShareFacebook() && $user->getFbAccessToken()) {
      if(!call_user_func_array(array($this->facebook_profile, $name), $args))
        throw new lmbException("Can't share with Facebook.", array('function_name' => $name, 'function_args' => $args));
    }

    if($settings->getSocialShareTwitter() && $user->getTwitterAccessToken() && $user->getTwitterAccessTokenSecret()) {
      if(!call_user_func_array(array($this->twitter_profile, $name), $args))
        throw new lmbException("Can't share with Twitter.", array('function_name' => $name, 'function_args' => $args));
    }
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
