<?php

/**
 * @desc Remove RemoteApiMock cache
 */
function task_od_remove_cache($argv)
{
	lmb_require('limb/fs/src/lmbFs.class.php');
	lmbFs::rm(taskman_prop('PROJECT_DIR').'/var/facebook_cache');
	lmbFs::rm(taskman_prop('PROJECT_DIR').'/var/twitter_cache');
}
