<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');

class AdminToolsController extends lmbController
{
	function doDeploy()
	{
		if (extension_loaded('newrelic'))
			newrelic_ignore_transaction();
		exec(lmb_env_get('APP_DIR').'/cli/update.sh 2>&1', $out, $this->status);
		$this->out = implode(PHP_EOL, $out);
	}
}
