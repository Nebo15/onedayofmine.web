<?php
lmb_require('src/service/social_profile/SocialServicesProfileInterface.class.php');

class TwitterProfile implements SocialServicesProfileInterface
{
  const ID = 'Twitter';

  /**
   * @var User
   */
  protected $user;
  /**
   * @var odTwitter
   */
  protected $provider;

  /**
   * @param User $user
   */
  public function __construct(User $user)
  {
    $config = [];
    $config['user_token']  = $user->getTwitterAccessToken();
    $config['user_secret'] = $user->getTwitterAccessTokenSecret();

    lmb_assert_true($config['user_token']);
    lmb_assert_true($config['user_secret']);

    $this->provider = new odTwitter($config);
    $this->user     = $user;

    if(lmb_env_get('USE_API_CACHE'))
      $this->provider = new odRemoteApiMock(
        $this->provider,
        lmbToolkit::instance()->createCacheConnectionByDSN('file:///'.lmb_var_dir().'/twitter_cache/'.$user->getTwitterAccessToken())
      );
 }

  /**
   * @return odTwitter
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
    return $this->provider->api('1/account/verify_credentials');;
  }

  /**
   * Returns accessible user profile information that corresponds database fields.
   *
   * @return array
   */
  function getInfo()
  {
    return self::_mapUserInfo($this->getInfo_Raw());
  }

  /**
   * Returns twitter ID of followed users.
   *
   * @return array
   */
  function getFriendsIds()
  {
    $cursor = '-1';
    $ids = array();
    while (true) {
      if ($cursor == '0')
        break;

      $response = $this->provider->api('1/friends/ids', odTwitter::METHOD_GET, array(
        'cursor' => $cursor
      ));

      if($response) {
        $ids = array_merge($ids, $response['ids']);
        $cursor = $response['next_cursor_str'];
      }
    }
    return $ids;
  }

  /**
   * Returns profile information of given twitter users.
   *
   * @return array
   */
  protected function getUsersByIds(array $ids)
  {
    $lookup = 100;
    $paging = ceil(count($ids) / $lookup);
    $users = array();
    for ($i=0; $i < $paging ; $i++) {
      $set = array_slice($ids, $i*$lookup, $lookup);

      $response = $this->provider->api('1/users/lookup', odTwitter::METHOD_GET, array(
        'user_id' => implode(',', $set)
      ));

      if ($response) {
        $users = array_merge($users, $response);
      }
    }
    return $users;
  }

  /**
   * Returns profile information of followed in twitter users.
   *
   * @return array
   */
  public function getFriends()
  {
    return $this->getUsersByIds($this->getFriendsIds());
  }

  /**
   * Returns users that registered in application and followed by user in twitter.
   *
   * @return array
   */
  public function getRegisteredFriends()
  {
    $results = array();
    foreach($this->getFriends() as $friend)
    {
      $info = $this->_mapUserInfo($friend);
      $user = User::findByTwitterUid($friend['id']);
      if(!$user)
        continue;
      $user->setUserInfo($info);
      $results[] = $user;
    }
    return $results;
  }

  /**
   * Returns user avatars.
   *
   * @return array
   */
  public function getPictures()
  {
    if($this->getInfo_Raw()['default_profile_image'])
      return array();

    $uid = $this->user->getTwitterUid();
    return array(
      '73x73' => 'http://api.twitter.com/1/users/profile_image?user_id='.$uid.'&size=bigger',
      '?x?'   => 'http://api.twitter.com/1/users/profile_image?user_id='.$uid.'&size=original'
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
    return $this->_tweet("Stay in touch with new day of my life. {$day_url}");
  }

  public function shareDay(Day $day, $day_url)
  {
    return $this->_tweet("Look how awesome is this day. {$day_url}");
  }

  public function shareDayLike(Day $day, $day_url)
  {
    return $this->_tweet("I really like this day. {$day_url}");
  }

  public function shareMomentAdd(Day $day, $day_url, Moment $moment, $moment_url)
  {
    return $this->_tweet("Look how awesome is this moment {$moment_url} in day {$day_url}.");
  }

  public function shareMomentLike(Moment $moment, $moment_url)
  {
    return $this->_tweet("I really like this moment. {$moment_url}");
  }

  public function shareDayEnd(Day $day, $day_url)
  {
    return $this->_tweet("This day is ended, review it here: {$day_url}.");
  }

  /**
   * Update twitter status.
   *
   * @param  string $string
   * @return mixed
   */
  protected function _tweet($string)
  {
    return $this->provider->api('1/statuses/update', odTwitter::METHOD_POST, array(
      'status' => $string
    ));
  }

  protected function _mapUserInfo($user_info)
  {
    return array(
        'twitter_uid'      => $user_info['id'],
        'name'             => $user_info['screen_name'],
        'timezone'         => $user_info['utc_offset'],
        'picture'          => $user_info['profile_image_url'],
        'current_location' => isset($user_info['location'])
                                  ? $user_info['location']
                                  : ''
    );
  }
}
