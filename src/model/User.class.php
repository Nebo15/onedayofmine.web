<?php
lmb_require('src/model/BaseModel.class.php');

/**
 * @method string getFbUserId()
 * @method void setFbUserId(string $fb_user_id)
 * @method string getFbAccessToken()
 * @method void setFbAccessToken(string $fb_access_token)
 */
class User extends lmbActiveRecord
{
	static function findByFbIdAndToken($fb_user_id, $fb_access_token)
	{
		return User::findOne(array(
      'fb_uid = ? AND fb_access_token = ?', $fb_user_id, $fb_access_token
		));
	}

  static function getFqlForGetUserInfo()
  {
    return 'SELECT
      uid, name, pic_small, pic_square, pic_big, profile_url
      FROM user WHERE uid = me()';
  }

  static function getFqlForGetUserFriendsInApplication()
  {
    return 'SELECT
      uid, name, pic_small, pic_square, pic_big, profile_url
      FROM user
      WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())';
  }


}
