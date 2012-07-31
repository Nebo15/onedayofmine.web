<?php

class FacebookProfile implements SocialServicesProfileInterface
{
  /**
   * @var User
   */
  protected $user;
  /**
   * @var odFacebook
   */
  protected $provider;

  /**
   * @param User       $user
   * @param odFacebook $provider
   */
  public function __construct(User $user, $provider)
  {
    $this->user     = $user;
    $this->provider = $provider;
  }

  /**
   * @return odFacebook
   */
  public function getProvider()
  {
    return $this->provider;
  }

  /**
   * Returns user profile information that provider allow to recieve.
   *
   * @return array
   */
  public function getInfo_Raw()
  {
    $raw = $this->provider->makeQuery('SELECT '.implode(',', self::_getUserFbFieldsMap()).' FROM user WHERE uid = me()');
    lmb_assert_true(count($raw));
    return $raw[0];
  }

  /**
   * Returns accessible user profile information that corresponds database fields.
   *
   * @return array
   */
  public function getInfo()
  {
    return self::_mapFbInfo($this->getInfo_Raw());
  }

  public function getRegisteredFriends()
  {
    $fields = implode(',', self::_getUserFbFieldsMap());
    $raw_infos = $this->provider->makeQuery("SELECT {$fields} FROM user WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())");
    $results = array();
    foreach($raw_infos as $raw_info)
    {
      $info = $this->_mapFbInfo($raw_info);
      $user = User::findByFbUid($info['fb_uid']);
      if(!$user)
        continue;
      $user->setUserInfo($info);
      $results[] = $user;
    }
    return $results;
  }

  /**
   * @param $day_url
   * @return string fb_id
   */
  public function shareDayBegin($day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/one-day-of-mine:begin", "post", array(
      'day' => $day_url
    ))['id'];
  }

  public function shareDay(Day $day, $day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    if(count($day->getMoments()))
      $image_url = lmbToolkit::instance()->getSiteUrl($day->getMoments()->at(0)->getImageUrl());
    else
      $image_url = '';

    return $this->provider->api("/me/feed", "post", array(
      'name' => $day->getTitle(),
      'picture' => $image_url,
      'link' => $day_url,
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  public function shareDayLike($day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/og.likes", "post", array(
      'object' => $day_url
    ));
  }

  public function shareMomentAdd($moment_url, $day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/one-day-of-mine:add_moment", "post", array(
      'moment' => $moment_url,
      'day' => $day_url
    ))['id'];
  }

  public function shareMomentLike($moment_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/og.likes", "post", array(
      'object' => $moment_url
    ));
  }

  public function shareDayEnd($day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/one-day-of-mine:end", "post", array(
      'day' => $day_url
    ));
  }

  protected function _getUserFbFieldsMap()
  {
  	return array(
      'uid', 'email', 'first_name', 'last_name', 'sex', 'timezone', 'profile_update_time',
      'pic_small', 'pic_square', 'pic_big', 'work', 'current_location', 'birthday_date'
    );
  }

  protected function _mapFbInfo($fb)
  {
  	return array(
  		'fb_uid'           => $fb['uid'],
      'email'            => $fb['email'],
  		'name'             => $fb['first_name'] . ' ' . $fb['last_name'],
  		'sex'              => $fb['sex'],
  		'timezone'         => $fb['timezone'],
  		'fb_profile_utime' => $fb['profile_update_time'],
  		'fb_pic_small'     => $fb['pic_small'],
  		'fb_pic_square'    => $fb['pic_square'],
  		'fb_pic_big'       => $fb['pic_big'],
  		'occupation'       => isset($fb['work']['position']['name'])
  	 													? $fb['work']['position']['name']
  														: '',
  		'current_location' => isset($fb['current_location']['name'])
  														? $fb['current_location']['name']
  														: '',
  		'birthday'         => date('Y-m-d', strtotime($fb['birthday_date']))
  	);
  }
}
