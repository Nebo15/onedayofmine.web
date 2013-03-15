<?php
lmb_require('src/model/base/BaseModel.class.php');

class Invitation extends BaseModel
{
	protected $_default_sort_params = array('id'=>'asc');
	protected $_db_table_name = 'invitation';

	public $code, $max_count, $taken_count, $ctime, $utime;

	/**
	 *@return Invitation
	 */
	static function findOneByCode($invitation_code)
	{
		return Invitation::findFirst(['code = ?', $invitation_code]);
	}
}