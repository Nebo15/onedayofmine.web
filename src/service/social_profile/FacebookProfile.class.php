<?php
lmb_require('src/service/social_profile/SocialServicesProfileInterface.class.php');

class FacebookProfile implements SocialServicesProfileInterface
{
  const ID = 'Facebook';
  /**
   * @var User
   */
  protected $user;
  /**
   * @var odFacebook
   */
  protected $provider;

  /**
   * @param User $user
   */
  public function __construct(User $user)
  {
    $this->provider = new odFacebook(odFacebook::getConfig());
    $this->provider->setAccessToken($user->getFbAccessToken());

    if(lmb_env_get('USE_API_CACHE'))
      $this->provider = new odRemoteApiMock(
        $this->provider,
        lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/facebook_cache/'.$user->getFbAccessToken())
      );

    $this->user     = $user;
  }

  /**
   * @return odFacebook
   */
  public function getProvider()
  {
    return $this->provider;
  }

  /**
   * Returns user profile information that social_provider allow to recieve.
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

  public function getFriends()
  {
    $fields = implode(',', self::_getUserFbFieldsMap());
    return $this->provider->makeQuery("SELECT {$fields} FROM user WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())");
  }

  public function getRegisteredFriends()
  {
    $results = array();
    foreach($this->getFriends() as $raw_info)
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

  public function getPictures()
  {
    $info = $this->getInfo_Raw();
    return array(
      '100x300' => $info['pic'],
      '200x600' => $info['pic_big']
    );
  }

  /**
   * Returns contents of picture.
   *
   * @param  string $url
   * @return string Binary string contents
   */
  public function getPictureContents($url)
  {
    return $this->getProvider()->downloadImage($url);
  }

  /**
   * @param $day_url
   * @return string fb_id
   */
  public function shareDayBegin(Day $day, $day_url)
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
      $image_url = lmbToolkit::instance()->getStaticUrl($day->getMoments()->at(0)->getImageUrl());
    else
      $image_url = '';

    return $this->provider->api("/me/feed", "post", array(
      'name' => $day->getTitle(),
      'picture' => $image_url,
      'link' => $day_url,
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  public function shareDayLike(Day $day, $day_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/og.likes", "post", array(
      'object' => $day_url
    ));
  }

  public function shareMomentAdd(Day $day, $day_url, Moment $moment, $moment_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/one-day-of-mine:add_moment", "post", array(
      'moment' => $moment_url,
      'day' => $day_url
    ))['id'];
  }

  public function shareMomentLike(Moment $moment, $moment_url)
  {
    if(!$this->user->getSettings()->getSocialShareFacebook())
      return null;

    return $this->provider->api("/me/og.likes", "post", array(
      'object' => $moment_url
    ));
  }

  public function shareDayEnd(Day $day, $day_url)
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
      'pic', 'pic_big', 'work', 'current_location', 'birthday_date'
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
  		'pic'              => $fb['pic'],
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
