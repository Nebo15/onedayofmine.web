<?php
lmb_require('limb/web_app/src/controller/lmbController.class.php');
lmb_require('src/Json.class.php');

abstract class WebAppController extends lmbController
{
	protected $lists_limit = 20;

	/**
	 * @var odTools
	 */
	protected $toolkit;

	protected function _getUser()
	{
		return $this->toolkit->getUser();
	}

	protected function _toFlatArray($object)
	{
		if(is_object($object))
		{
			$res = new lmbSet();
			foreach((array) $object as $name => $value)
				$res->$name = $this->_toFlatArray($value);
			return $res;
		}
		elseif(is_array($object))
		{
			$res = [];
			foreach($object as $key => $one_value)
				$res[$key] = $this->_toFlatArray($one_value);
			return $res;
		}
		else
		{
			return $object;
		}
	}

	function doNotFound()
	{
		$this->response->setCode(404);
	}

	function forwardTo404()
	{
		$this->response->setCode(404);
		$this->setTemplate('pages/not_found.phtml');
	}

	function forwardToUnauthorized()
	{
		$this->response->setCode(401);
		$this->setTemplate('pages/not_authorized.phtml');
	}
}