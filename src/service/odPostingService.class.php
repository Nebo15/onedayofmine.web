<?php
lmb_require('src/service/social_profile/SharesInterface.class.php');
lmb_require('src/service/social_profile/FacebookProfile.class.php');
lmb_require('src/service/social_profile/TwitterProfile.class.php');

class odPostingService implements SharesInterface
{
  protected $facebook_profile;
  protected $twitter_profile;

  /**
   * @throws lmbException
   */
  protected function share($name, $args)
  {
    /** @var $user User */
    $user = lmbToolkit::instance()->getUser();
    lmb_assert_true($user, 'User is not logged in!');
    $settings = $user->getSettings();

    $result = [];

    // Facebook
    if($settings->social_share_facebook)
    {
      $this->facebook_profile = $this->facebook_profile ?: new FacebookProfile($user);

      if(!$result['facebook'] = call_user_func_array(array($this->facebook_profile, $name), $args))
        throw new lmbException("Can't share with Facebook.", array('function_name' => $name, 'function_args' => $args));
    }

    // Twitter
    if($settings->social_share_twitter && $user->twitter_access_token && $user->twitter_access_token_secret)
    {
        $this->twitter_profile = $this->twitter_profile ?: new TwitterProfile($user);

        if(!$result['twitter'] = call_user_func_array(array($this->twitter_profile, $name), $args))
          throw new lmbException("Can't share with Twitter.", array('function_name' => $name, 'function_args' => $args));
    }

    return $result;
  }

  public function shareInvitation($social_user_id){}

  public function shareDayBegin(Day $day)
  {
    $result = $this->share('shareDayBegin', func_get_args());
    $this->setObjectIds($day, $result);
    return $result;
  }

  public function shareDay(Day $day)
  {
    return $this->share('shareDay', func_get_args());
  }

  public function shareDayDelete(Day $day) {}

  public function shareDayLike(Day $day, DayLike $like)
  {
    $result = $this->share('shareDayLike', func_get_args());
    $this->setObjectIds($like, $result);
    return $result;
  }

  public function shareDayUnlike(Day $day, DayLike $like) {
    return $this->share('shareDayUnlike', func_get_args());
  }

  public function shareMomentAdd(Day $day, Moment $moment)
  {
    $result = $this->share('shareMomentAdd', func_get_args());
    $this->setObjectIds($moment, $result);
    return $result;
  }

  public function shareMomentDelete(Day $day, Moment $moment) {}

  public function shareMomentLike(Moment $moment, MomentLike $like)
  {
    $result = $this->share('shareMomentLike', func_get_args());
    $this->setObjectIds($like, $result);
    return $result;
  }

  public function shareMomentUnlike(Moment $moment, MomentLike $like)
  {
    return $this->share('shareMomentUnlike', func_get_args());
  }

  public function shareDayEnd(Day $day)
  {
    $result = $this->share('shareDayEnd', func_get_args());
    // $this->setObjectIds($like, $result);
    return $result;
  }

  protected function setObjectIds(odLightAR $object, array $result)
  {
    foreach ($result as $key => $value) {
      $property_name = $key.'_id';
      $object->$property_name = $value;
    }
    $object->save();
  }
}
