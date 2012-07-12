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
  protected function _defineRelations()
  {
    $this->_has_one = array (
      'user_settings' => array (
        'field' => 'user_settings_id',
        'class' => 'UserSettings',
        'can_be_null' => true
      )
    );
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

  protected function _createValidator()
  {
  	$validator = new lmbValidator();
  	$validator->addRequiredRule('first_name');
  	$validator->addRequiredRule('last_name');
  	$validator->addRequiredRule('fb_uid');
  	$validator->addRequiredRule('fb_access_token');
  	$validator->addRequiredRule('fb_profile_url');
  	$validator->addRequiredRule('fb_profile_utime');
  	$validator->addRequiredRule('fb_pic_big');
  	$validator->addRequiredRule('fb_pic_square');
  	$validator->addRequiredRule('fb_pic_small');
  	$validator->addRequiredRule('timezone');
  	$validator->addRequiredRule('sex');
  	$validator->addRequiredRule('birthday');
  	return $validator;
  }

  /**
   * @return FacebookUser
   */
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

    unset($result['fb_access_token']);
    unset($result['cip']);
    unset($result['user_settings_id']);
    ksort($result);
    return (object) $result;
  }

  function setSettings(UserSettings $settings)
  {
    $this->setUserSettings($settings);
  }

  function getSettings()
  {
    if(!$item = $this->getUserSettings())
    {
      $item = UserSettings::createDefault($this);
    }
    return $item;
  }
}
