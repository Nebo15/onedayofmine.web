<?php
lmb_require('limb/cms/src/model/lmbCmsUserRoles.class.php');

$editor = array(array('title' => 'Контент', 'icon' => '/shared/cms/images/icons/menu_content.png',  'children' => array(
  array(
    'title' => 'Days',
    'url' => '/admin_day',
    'icon' => '/shared/cms/images/icons/layout.png',
  ),
  array(
    'title' => 'Interesting',
    'url' => '/admin_day/interesting/',
    'icon' => '/shared/cms/images/icons/layout.png',
  ),
  array(
    'title' => 'Users',
    'url' => '/admin_user',
    'icon' => '/shared/cms/images/icons/layout.png',
  ),
)));

$only_admin = array(array('title' => 'Администрирование', 'icon' => '/shared/cms/images/icons/menu_service.png','children' => array(
  array(
    'title' => 'Admins',
    'url' => '/admin_user',
    'icon' => '/shared/cms/images/icons/user.png',
  ),
)));

$conf = array(
  lmbCmsUserRoles :: EDITOR  => $editor,
  lmbCmsUserRoles :: ADMIN  => array_merge_recursive($editor, $only_admin)
);

