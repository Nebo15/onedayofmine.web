<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');

class AdminObjectController extends lmbAdminObjectController
{
	function doDisplay()
	{
		$this->items = call_user_func_array([$this->_object_class_name, 'find'], [null, $this->_getSortParams()]);
	}

	protected function _getSortParams()
	{
		$default_sort = $this->_default_sort ? array_keys($this->_default_sort)[0] : 'id';
		$sort = $this->toolkit->getRequest()->getGetFiltered('sort', FILTER_SANITIZE_SPECIAL_CHARS, $default_sort);

		$default_direction = $this->_default_sort ? array_values($this->_default_sort)[0] : 'asc';
		$direction = $this->toolkit->getRequest()->getGet('direction', $default_direction);

		return [$sort => $direction];
	}
}