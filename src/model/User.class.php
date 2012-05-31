<?php
lmb_require('src/model/BaseModel.class.php');

/**
 *@SwaggerModel(
 *     id="user",
 *     description="some long description of the model"
 * )
 * @property integer $id
 */
class User extends lmbActiveRecord
{
	static function findByFbIdAndToken($fb_user_id, $fb_access_token)
	{
		return User::findOne(array(
      'fb_uid = ? AND fb_access_token = ?', $fb_user_id, $fb_access_token
		));
	}
}
