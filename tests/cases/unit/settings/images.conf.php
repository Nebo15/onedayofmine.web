<?php
require('settings/images.conf.php');

$conf['ImageableForTests'] = array(
  'path'      => 'ImageableForTests_:id_:image_width.:file_extension',
  'sizes'     => array(
    array('width' => 266, 'height' => 266),
    array('width' => 532, 'height' => 532),
  ),
);
