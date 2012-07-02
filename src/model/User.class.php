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

  protected function _defineRelations()
  {
    $this->_has_many = array (
      'days' => array (
        'field' => 'user_id',
        'class' => 'Day',
        'criteria' =>'`day`.`is_deleted` = 0'
      ),
      'days_comments' => array ('field' => 'user_id', 'class' => 'DayComment'),
      'moments_comments' => array ('field' => 'user_id', 'class' => 'MomentComment'),
    );
    $this->_has_many_to_many = array(
      'favourite_days' => array(
        'field' => 'user_id',
        'foreign_field' => 'day_id',
        'table' => 'day_favourite',
        'class' => 'Day',
        'criteria' => '`day`.`is_deleted` = 0'),
      'followers' => array(
        'field' => 'user_id',
        'foreign_field' => 'follower_user_id',
        'table' => 'user_following',
        'class' => 'User'),
      'following' => array(
        'field' => 'follower_user_id',
        'foreign_field' => 'user_id',
        'table' => 'user_following',
        'class' => 'User'),
    );
  }

  function setUserInfo($user_info)
  {
    $this->user_info_from_fb = $user_info;
  }

  function getUserInfo()
  {
    if(!$this->user_info_from_fb)
      $this->user_info_from_fb = $this->getFacebookUser()->getUserInfo();
    return $this->user_info_from_fb;
  }

  function getFacebookUser()
  {
    return new FacebookUser($this);
  }

  static function findByFbAccessToken($fb_access_token)
  {
    return User::findOne(array('fb_access_token = ?', $fb_access_token));
  }

  static function findByFbUid($fb_uid)
  {
    return User::findOne(array('fb_uid = ?', $fb_uid));
  }

  function exportForApi()
  {
    $result = $this->export();
    if($result['user_info_from_fb'])
      $result = array_merge($result, $result['user_info_from_fb']);
    else
      $result = array_merge($result, $this->getUserInfo());
    unset($result['user_info_from_fb']);
    unset($result['fb_access_token']);
    unset($result['cip']);
    ksort($result);
    return (object) $result;
  }
}
