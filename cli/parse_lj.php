<?php
set_time_limit(0);
error_reporting(E_ALL | ~E_STRICT);

$app_dir = realpath(__DIR__."/..");
$libs_dir = $app_dir . '/lib';

set_include_path(implode(PATH_SEPARATOR,
  array($app_dir, $libs_dir, get_include_path())
));

date_default_timezone_set('Europe/Kiev');

require_once('limb/core/common.inc.php');
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
