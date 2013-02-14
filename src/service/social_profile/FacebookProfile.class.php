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

  protected $pages_base_url;

  protected $namespace;

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
    $access_token    = $user->facebook_access_token;

    lmb_assert_true($user, 'Facebook profile user not specified.');
    lmb_assert_true($access_token, 'Facebook access token not specified.');

    $this->provider  = lmbToolkit::instance()->getFacebook($access_token);
    $this->user      = $user;
    $this->namespace = lmbToolkit::instance()->getConf('facebook')->namespace;
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
    $raw = $this->provider->makeQuery('SELECT '.implode(',', self::_getUserFacebookFieldsMap()).' FROM user WHERE uid = me()');
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
    return self::_mapFacebookInfo($this->getInfo_Raw());
  }

  public function getFriends()
  {
    $fields = implode(',', self::_getUserFacebookFieldsMap());
    $fql_result = $this->provider->makeQuery("SELECT {$fields}, is_app_user FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) ORDER BY first_name");

    $friends = [];
    if($fql_result)
    {
      foreach($fql_result as $raw_info)
      {
        $friends[] = $this->_mapFacebookInfo($raw_info);
      }
    }

    return $friends;
  }

  public function getRegisteredFriends()
  {
    $results = array();
    foreach($this->getFriends() as $info)
    {
      if($user = User::findByFacebookUid($info['facebook_uid']))
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

  public function shareInvitation($facebook_user_id)
  {
    return $this->provider->api("/{$facebook_user_id}/feed", "post", array(
      'name'        => 'One Day of Mine invitation',
      // 'picture'     => count($day->getMoments()) ? lmbToolkit::instance()->getStaticUrl($day->getImage()) : '',
      'link'        => lmbToolkit::instance()->getSiteUrl(),
      'description' => "Hi, come and check out my photos in One Day of Mine, where people share days of their lifes.",
    ))['id'];
  }

  public function shareDayBegin(Day $day)
  {
    return $this->provider->api("/me/".$this->namespace.":begin", "post", array(
      'day' => $this->_getPageUrl($day)
    ))['id'];
  }

  public function shareDay(Day $day)
  {
    return $this->provider->api("/me/feed", "post", array(
      'name'        => $day->title,
      'picture'     => count($day->getMoments()) ? lmbToolkit::instance()->getStaticUrl($day->getImage()) : '',
      'link'        => $this->_getPageUrl($day),
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  public function shareDayDelete(Day $day) {}

  public function shareDayLike(Day $day, DayLike $like)
  {
    return $this->provider->api("/me/og.likes", "post", array(
      'object'      => $this->_getPageUrl($day)
    ))['id'];
  }

  public function shareDayUnlike(Day $day, DayLike $like)
  {
	  if($like->facebook_id)
      return $this->_deleteBuiltInLike($like->facebook_id);
  }

  public function shareMomentAdd(Day $day, Moment $moment)
  {
    return $this->provider->api("/me/".$this->namespace.":add_moment", "post", array(
      'moment'      => $this->_getPageUrl($moment),
      'day'         => $this->_getPageUrl($day)
    ))['id'];
  }

  public function shareMomentDelete(Day $day, Moment $moment) {}

  public function shareMomentLike(Moment $moment, MomentLike $like)
  {
    return $this->provider->api("/me/og.likes", "post", array(
      'object'      => $this->_getPageUrl($moment)
    ))['id'];
  }

  public function shareMomentUnlike(Moment $moment, MomentLike $like)
  {
    return $this->_deleteBuiltInLike($like->getFacebookId());
  }

  public function shareDayEnd(Day $day)
  {
    return $this->provider->api("/me/".$this->namespace.":end", "post", array(
      'day'         => $this->_getPageUrl($day)
    ));
  }

  protected function _deleteBuiltInLike($like_instance_id)
  {
    return $this->provider->api("/{$like_instance_id}", "delete");
  }

  protected function _getPageUrl($object)
  {
    return lmbToolkit::instance()->getPageUrl($object);
  }

  protected function _getUserFacebookFieldsMap()
  {
    return array(
      'uid', 'email', 'first_name', 'last_name', 'sex', 'timezone', 'profile_update_time',
      'pic', 'pic_big', 'work', 'current_location', 'birthday_date'
    );
  }

  protected function _mapFacebookInfo($fb)
  {
    return array(
      'facebook_uid'     => $fb['uid'],
      'email'            => $fb['email'],
      'name'             => $fb['first_name'] . ' ' . $fb['last_name'],
      'sex'              => $fb['sex'],
      'timezone'         => $fb['timezone'],
      'facebook_profile_utime' => $fb['profile_update_time'],
      'pic'              => $fb['pic'],
      'pic_big'          => $fb['pic_big'],
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
