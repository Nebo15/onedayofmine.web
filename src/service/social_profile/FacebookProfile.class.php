<?php
lmb_require('src/service/social_provider/odFacebook.class.php');
lmb_require('src/service/social_profile/SocialServicesProfileInterface.class.php');
lmb_require('src/service/social_profile/SharesInterface.class.php');

class FacebookProfile implements SocialServicesProfileInterface, SharesInterface
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
   * Hashes of default usepics on facebook.
   */
  const DEFAULT_MALE_PIC_HASH   = 'e68ff6c48a3b96354d1830437545b7f5fcf980cb';
  const DEFAULT_FEMALE_PIC_HASH = 'c2c3b583435d6856141e55a0267c3d436c3ecb2b';

  /**
   * @param User $user
   */
  public function __construct(User $user)
  {
    $access_token   = $user->getFbAccessToken();

    lmb_assert_true($user, 'Facebook profile user not specified.');
    lmb_assert_true($access_token, 'Facebook access token not specified.');

    $this->provider = lmbToolkit::instance()->getFacebook($access_token);
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
    // $pic_hash = sha1($this->getPictureContents($info['pic']));
    // if($pic_hash == self::DEFAULT_MALE_PIC_HASH || $pic_hash == self::DEFAULT_FEMALE_PIC_HASH)
    //   return array();

    $arr = explode('.', $info['pic']);
    $arr2 = explode('.', $info['pic_big']);
    if(array_pop($arr) == 'gif' || array_pop($arr2) == 'gif')
      return array();

    return array(
      '100x300' => $info['pic'],
      '200x600' => $info['pic_big'],
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

  public function shareDayBegin(Day $day)
  {
    return $this->provider->api("/me/one-day-of-mine:begin", "post", array(
      'day' => lmbToolkit::instance()->getPageUrl($day)
    ))['id'];
  }

  public function shareDay(Day $day)
  {
    return $this->provider->api("/me/feed", "post", array(
      'name'        => $day->getTitle(),
      'picture'     => count($day->getMoments()) ? lmbToolkit::instance()->getStaticUrl($day->getMoments()->at(0)->getImageUrl()) : '',
      'link'        => lmbToolkit::instance()->getPageUrl($day),
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  public function shareDayLike(Day $day)
  {
    return $this->provider->api("/me/og.likes", "post", array(
      'object'      => lmbToolkit::instance()->getPageUrl($day)
    ));
  }

  public function shareMomentAdd(Day $day, Moment $moment)
  {
    return $this->provider->api("/me/one-day-of-mine:add_moment", "post", array(
      'moment'      => lmbToolkit::instance()->getPageUrl($moment),
      'day'         => lmbToolkit::instance()->getPageUrl($day)
    ))['id'];
  }

  public function shareMomentLike(Moment $moment)
  {
    return $this->provider->api("/me/og.likes", "post", array(
      'object'      => lmbToolkit::instance()->getPageUrl($moment)
    ));
  }

  public function shareDayEnd(Day $day)
  {
    return $this->provider->api("/me/one-day-of-mine:end", "post", array(
      'day'         => lmbToolkit::instance()->getPageUrl($day)
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
