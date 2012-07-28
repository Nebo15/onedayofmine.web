<?php

class TwitterUser implements SocialServicesUserInterface
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
   * @param User      $user
   * @param odTwitter $provider
   */
  public function __construct(User $user, $provider)
  {
    $this->user     = $user;
    $this->provider = $provider;
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

  public function getFriendsIds()
  {
    $cursor = '-1';
    $ids = array();
    while (true) {
      if ($cursor == '0')
        break;

      $tmhOAuth->request('GET', $tmhOAuth->url('1/friends/ids'), array(
        'cursor' => $cursor
      )); // TODO $provider->api

      if ($tmhOAuth->response['code'] == 200) {
        $data = json_decode($tmhOAuth->response['response'], true);
        $ids = array_merge($ids, $data['ids']);
        $cursor = $data['next_cursor_str'];
      }
      // usleep(500000);
    }
    return $ids;
  }

  public function getRegisteredFriends()
  {

  }

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
        'sex'              => $user_info['sex'],
        'timezone'         => $user_info['utc_offset'],
        'picture'          => $user_info['profile_image_url'],
        'occupation'       => '',
        'current_location' => isset($user_info['location'])
                                  ? $user_info['location']
                                  : '',
        'birthday'         => ''
    );
  }
}
