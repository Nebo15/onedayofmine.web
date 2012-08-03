<?php

class TwitterProfile implements SocialServicesProfileInterface
{
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

    $this->provider = new odTwitter($config);
    $this->user     = $user;

    if(lmbToolkit::instance()->getConf('common')->remote_api_cache_enabled)
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
   * Returns user profile information that provider allow to recieve.
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
  public function getInfo()
  {
    return self::_mapUserInfo($this->getInfo_Raw());
  }

  /**
   * Returns twitter ID of followed users.
   *
   * @return array
   */
  public function getFriendsIds()
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
   */
  public function getPictures()
  {
    $uid = $this->user->getTwitterUid();
    return [
      '73x73' => 'http://api.twitter.com/1/users/profile_image?user_id='.$uid.'&size=bigger',
      '?x?'   => 'http://api.twitter.com/1/users/profile_image?user_id='.$uid.'&size=original'
    ];
  }

  /**
   * Update twitter status.
   *
   * @param  string $string
   * @return mixed
   */
  public function tweet($string)
  {
    return $this->provider->api('1/statuses/update', odTwitter::METHOD_POST, array(
      'status' => $string
    ));
  }

  /**
   * @param $day_url
   * @return string fb_id
   */
  public function shareDayBegin($day_url)
  {
    return $this->tweet("Stay in touch with new day of my life. {$day_url}");
  }

  public function shareDay(Day $day, $day_url)
  {
    return $this->tweet("Look how awesome is this day. {$day_url}");
  }

  public function shareDayLike($day_url)
  {
    return $this->tweet("I really like this day. {$day_url}");
  }

  public function shareMomentAdd($moment_url, $day_url)
  {
    return $this->tweet("Look how awesome is this moment {$moment_url} in day {$day_url}.");
  }

  public function shareMomentLike($moment_url)
  {
    return $this->tweet("I really like this moment. {$moment_url}");
  }

  public function shareDayEnd($day_url)
  {
    return $this->tweet("This day is ended, review it here: {$day_url}.");
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
