<?php

class EditorAction extends BaseModel
{
	protected $_db_table_name = 'editor_action';
	protected $_default_sort_params = array('id'=>'DESC');

	public $user_id, $day_id, $moment_id;
	public $class_name, $action;
	public $ctime, $cip;

	function setUser(User $user)
	{
		$this->user_id = $user->id;
	}

	function getUser()
	{
		return User::findById($this->user_id);
	}

	function fillAction(odStrictPropsObject $orig, odStrictPropsObject $modified)
	{
		$diff = [];
		foreach($orig->getPropertiesNames() as $prop)
		{
			if($prop == 'utime')
				continue;
			if($orig->$prop != $modified->$prop)
				$diff[] = [ 'property' => $prop, 'orig' => $orig->$prop, 'modified' => $modified->$prop];
		}
		$this->action = json_encode($diff, JSON_UNESCAPED_UNICODE);
	}

	static function findByUserId($user_id)
	{
		return self::findFirst(lmbSQLCriteria::equal('user_id', $user_id));
	}
}
