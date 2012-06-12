<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @method string getFbUid()
 * @method void setFbUid(string $fb_user_id)
 * @method string getFbAccessToken()
 * @method void setFbAccessToken(string $fb_access_token)
 */
class User extends BaseModel
{
  protected $user_info_from_fb;

  function setUserInfo($user_info)
  {
    $this->user_info_from_fb = $user_info;
  }

  function getUserInfo()
  {
    if(!$this->user_info_from_fb)
      $this->user_info_from_fb = $this->loadUserInfoFromFb();
    return $this->user_info_from_fb;
  }

  function loadUserInfoFromFb()
  {
    $raw = $this->_getFacebook()->makeQuery('SELECT
    uid, name, sex, timezone, profile_update_time, pic_small, pic_square, pic_big, profile_url
    FROM user WHERE uid = me()');
    lmb_assert_true(count($raw));
    return $this->_mapFbInfo($raw[0]);
  }

  function getGetUserFriendsInApplicationFromFb()
  {
    $raw_infos = $this->_getFacebook()->makeQuery('SELECT
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

  static function findByFbAccessToken($fb_access_token)
  {
    return User::findOne(array('fb_access_token = ?', $fb_access_token));
  }

  static function findByFbUid($fb_uid)
  {
    return User::findOne(array('fb_uid = ?', $fb_uid));
  }

  protected function _mapFbInfo($fb_results)
  {
    $fb_results['fb_uid'] = $fb_results['uid'];
    unset($fb_results['uid']);
    $fb_results['fb_name']        = $fb_results['name'];
    unset($fb_results['name']);
    $fb_results['fb_profile_url'] = $fb_results['profile_url'];
    unset($fb_results['profile_url']);
    $fb_results['fb_profile_utime'] = $fb_results['profile_update_time'];
    unset($fb_results['profile_update_time']);
    return $fb_results;
  }
  /**
   * @return OneDayFacebook
   */
  protected function _getFacebook()
  {
    lmb_assert_true($this->getFbAccessToken());
    return lmbToolkit::instance()->getFacebook($this->getFbAccessToken());
  }


  function exportToSimpleObj()
  {
    $result = $this->export();
    $result = array_merge($result, $result['user_info_from_fb']);
    unset($result['user_info_from_fb']);
    unset($result['fb_access_token']);
    ksort($result);
    return (object) $result;
  }
}
