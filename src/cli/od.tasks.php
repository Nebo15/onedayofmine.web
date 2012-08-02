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
 * @desc Fill db from lj community
 * @deps migrate_load_all,migrate_run
 */
function task_od_fill_from_lj($argv)
{
	$app_dir = taskman_prop('PROJECT_DIR');

  lmb_require($app_dir.'setup.php');
	lmb_require('ljparse/*.class.php');
  lmb_require('tests/src/toolkit/odTestsTools.class.php');
  lmb_require($app_dir.'tests/src/odObjectMother.class.php');

	define('LJ_COMMUNITY_NAME', 'odin-moy-den');

  $generator = new odObjectMother();

	$mainPage = new MainPage(new MainPageRegexpParser());
	$mainPage->getRemoteContent(LJ_COMMUNITY_NAME, 1);

	$links_list = $mainPage->getLinksToContentPages();
	$links_list = array($links_list[0], $links_list[1]);

	$contentPageParser = new ContentPageRegexpParser();
	$posts = array();
	foreach($links_list as $post_id)
  {
    $post = new ContentPage($contentPageParser);
		$post->getRemoteContent(LJ_COMMUNITY_NAME, $post_id);
    $posts[] = $post;
	}


  lmbToolkit :: merge(new odTestsTools());
  $tests_users = lmbToolkit::instance()->getTestsUsers();

	foreach($posts as $id => $post)
  {
    $day = new Day();
    $day->setTitle($post->getTitle());
    $day->setUser($tests_users[$id]);
    $day->setOccupation($generator->string(6));
    $day->setTimezone(0);
    $day->setLocation($generator->string(6));
    $day->setType('trip');
    $day->save();

    foreach($post->getMoments() as $moment_data)
    {
      $moment = new Moment();
      $moment->setDescription($moment_data['description']);
      $moment->setDay($day);
      $moment->save();
      $moment->attachImage('foo.jpg', file_get_contents($moment_data['img']));
      $moment->save();
    }
	}

}
