<?php

/**
 * @desc Foo
 */
function task_od_remove_fbcache($argv)
{
	lmb_require('limb/fs/src/lmbFs.class.php');
	lmbFs::rm(taskman_prop('PROJECT_DIR').'/var/facebook_cache');
	lmbFs::rm(taskman_prop('PROJECT_DIR').'/tests/var/facebook_cache');
}

/**
 * @desc Parse lj community
 * @param unknown_type $argv
 */
function task_od_parse_lj($argv)
{
	$app_dir = taskman_prop('PROJECT_DIR');

	lmb_require('ljparse/*.class.php');

	define('LJ_COMMUNITY_NAME', 'odin-moy-den');

	$mainPage = new MainPage(new MainPageRegexpParser());
	$mainPage->getRemoteContent(LJ_COMMUNITY_NAME, 1);

	$links_list = $mainPage->getLinksToContentPages();
	$links_list = array($links_list[0], $links_list[1]);

	$contentPageParser = new ContentPageRegexpParser();
	$posts = array();
	foreach($links_list as $post_id) {
		$posts[$post_id] = new ContentPage($contentPageParser);
		$posts[$post_id]->getRemoteContent(LJ_COMMUNITY_NAME, $post_id);
	}

	foreach($posts as $post_id => $post) {
		var_dump($post->getData());
	}

}