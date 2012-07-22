<?php

class FacebookUser
{
  /**
   * @var User
   */
  protected $user;

  function __construct(User $user = null)
  {
    $this->user = $user;
  }

  /**
   * @return odFacebook
   */
  function getFacebook()
  {
    lmb_assert_true($this->user->getFbAccessToken());
    return lmbToolkit::instance()->getFacebook($this->user->getFbAccessToken());
  }

  static function getUserInfo($fb_access_token)
  {
  	lmb_assert_true($fb_access_token);
  	$facebook = lmbToolkit::instance()->getFacebook($fb_access_token);
    $raw = $facebook->makeQuery(
      'SELECT '.implode(',', self::_getUserFbFieldsMap()).' FROM user WHERE uid = me()');
    lmb_assert_true(count($raw));
    return self::_mapFbInfo($raw[0]);
  }

  static protected function _getUserFbFieldsMap()
  {
  	return array('uid', 'first_name', 'last_name', 'sex', 'timezone', 'profile_update_time',
  	  'pic_small', 'pic_square', 'pic_big', 'profile_url', 'work', 'current_location',
  		'birthday_date');
  }

  static protected function _mapFbInfo($fb)
  {
  	return array(
  			'fb_uid'           => $fb['uid'],
  			'first_name'       => $fb['first_name'],
  			'last_name'        => $fb['last_name'],
  			'sex'              => $fb['sex'],
  			'timezone'         => $fb['timezone'],
  			'fb_profile_url'   => $fb['profile_url'],
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

  function getUserFriendsInApplication()
  {
    $raw_infos = $this->getFacebook()->makeQuery('SELECT '.implode(',', self::_getUserFbFieldsMap()).
      ' FROM user WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())');
    $results = array();
    foreach($raw_infos as $raw_info)
    {
      $info = $this->_mapFbInfo($raw_info);
      $user = User::findByFbUid($info['fb_uid']);
      if(!$user)
        throw new lmbException("User not found by fb_uid", array('fb_uid' => $info['fb_uid']));
      $user->setUserInfo($info);
      $results[] = $user;
    }
    return $results;
  }

  function beginDay($day_url)
  {
    return $this->getFacebook()->api("/me/one-day-of-mine:begin", "post", array(
      'day' => $day_url
    ));
  }

  function shareDay(Day $day, $day_url)
  {
    if(count($day->getMoments()))
      $image_url = lmbToolkit::instance()->getSiteUrl($day->getMoments()->at(0)->getImageUrl());
    else
      $image_url = '';
    return $this->getFacebook()->api("/me/feed", "post", array(
      'name' => $day->getTitle(),
      'picture' => $image_url,
      'link' => $day_url,
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  function likeDay($day_url)
  {
    return $this->getFacebook()->api("/me/og.likes", "post", array(
      'object' => $day_url
    ));
  }

  function addMoment(Moment $moment, $day_url)
  {
    return $this->getFacebook()->api("/me/one-day-of-mine:add_moment", "post", array(
      'day' => $day_url,
      'image' => lmbToolkit::instance()->getSiteUrl($moment->getImageUrl()),
      'message' => $moment->getDescription()
    ));
  }

  function shareMoment(Moment $moment, $moment_url)
  {
    $image_url = lmbToolkit::instance()->getSiteUrl($moment->getImageUrl());
    return $this->getFacebook()->api("/me/feed", "post", array(
      'name' => $moment->getDay()->getTitle(),
      'picture' => $image_url,
      'link' => $moment_url,
      'description' => $moment->getDescription(),
    ));
  }

  function likeMoment($moment_url)
  {
    return $this->getFacebook()->api("/me/og.likes", "post", array(
      'object' => $moment_url
    ));
  }

  function endDay($day_url)
  {
    return $this->getFacebook()->api("/me/one-day-of-mine:end", "post", array(
      'day' => $day_url
    ));
  }
}
