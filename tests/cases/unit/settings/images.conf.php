<?php
require('settings/images.conf.php');

$conf['ImageableForTests'] = array(
  'path'      => 'tests/:id_:image_width.:file_extension',
  'save_path' => "www/users",
  'sizes'     => array(
    array('width' => 266, 'height' => 266),
    array('width' => 532, 'height' => 532),
  ),
);
