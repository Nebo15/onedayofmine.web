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
      'SELECT
        uid, name, sex, timezone, profile_update_time, pic_small, pic_square, pic_big, profile_url
        FROM user WHERE uid = me()');
    lmb_assert_true(count($raw));
    return self::_mapFbInfo($raw[0]);
  }

  static protected function _mapFbInfo($fb_results)
  {
    $fb_results['fb_uid'] = $fb_results['uid'];
    unset($fb_results['uid']);
    $fb_results['fb_profile_url'] = $fb_results['profile_url'];
    unset($fb_results['profile_url']);
    $fb_results['fb_profile_utime'] = (int) $fb_results['profile_update_time'];
    unset($fb_results['profile_update_time']);
    $fb_results['fb_pic_big'] = $fb_results['pic_big'];
    unset($fb_results['pic_big']);
    $fb_results['fb_pic_square'] = $fb_results['pic_square'];
    unset($fb_results['pic_square']);
    $fb_results['fb_pic_small'] = $fb_results['pic_small'];
    unset($fb_results['pic_small']);
    return $fb_results;
  }

  function getUserFriendsInApplication()
  {
    $raw_infos = $this->getFacebook()->makeQuery('SELECT
      uid, name, sex, timezone, profile_update_time, pic_small, pic_square, pic_big, profile_url
      FROM user
      WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())');
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

  function beginDay(Day $day)
  {
    return $this->getFacebook()->api("/me/one-day-of-mine:begin", "post", array(
      'day' => lmbToolkit::instance()->getSiteUrl('/days/'.$day->getId().'/item')
    ));
  }

  function shareDay(Day $day)
  {
    //http://developers.facebook.com/docs/reference/api/post/
    return $this->getFacebook()->api("/me/feed", "post", array(
      'name' => $day->getTitle(),
      'picture' => $this->getSiteUrl($day->getMoments()->at(0)->getImageUrl()),
      'link' => $this->getSiteUrl('/days/'.$day->getId().'/item'),
      'description' => 'Visit onedayofmine.com for more info',
    ));
  }

  function likeDay(Day $link_to_object)
  {
    return $this->getFacebook()->api("/me/og.likes", "post", array(
      'object' => $link_to_object
    ));
  }

  function getSiteUrl($path)
  {
    return lmbToolkit::instance()->getSiteUrl($path);
  }
}
