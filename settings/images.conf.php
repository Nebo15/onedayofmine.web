<?php

$conf = array(
  'Day' => array(
    'path'      => ':user_id/days/:hash_:image_width.:file_extension',
    'save_path' => 'www/users',
    'sizes'     => array(
                     array('width' => 266, 'height' => 266),
                     array('width' => 532, 'height' => 532),
                   ),
  ),
  'Moment' => array(
    'path'      => ':user_id/days/:day_id/:hash_:image_width.:file_extension',
    'save_path' => 'www/users',
    'sizes'     => array(
                     array('width' => 266, 'height' => 266),
                     array('width' => 532, 'height' => 532),
                   ),
  ),
  'User' => array(
    'path'      => ':id/:hash_:image_width.:file_extension',
    'save_path' => 'www/users',
    'sizes'     => array(
                     array('width' => 36, 'height'  => 36),
                     array('width' => 72, 'height'  => 72),
                     array('width' => 96, 'height'  => 96),
                     array('width' => 192, 'height' => 192),
                   ),
  ),
);
