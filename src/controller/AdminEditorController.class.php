<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/EditorAction.class.php');

class AdminEditorController extends lmbController
{
	function doDisplay()
	{
		$this->items = EditorAction::find();
	}
}