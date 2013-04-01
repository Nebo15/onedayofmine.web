<?php
$conf = array(
	'save_path' => 'www',
	'Day'    => array(
		'path'      => 'users/days/:hash_:image_width.:file_extension',
		'sizes'     => array(
			array('width' => 266, 'height' => 266),
			array('width' => 532, 'height' => 532),
		),
	),
	'Moment' => array(
		'path'      => 'users/days/:day_id/:hash_:image_width.:file_extension',
		'sizes'     => array(
			array('width' => 266, 'height' => 266),
			array('width' => 532, 'height' => 532),
		),
	),
	'User'   => array(
		'path'      => 'users/:id/:hash_:image_width.:file_extension',
		'sizes'     => array(
			array('width' => 36, 'height'  => 36),
			array('width' => 72, 'height'  => 72),
			array('width' => 96, 'height'  => 96),
			array('width' => 192, 'height' => 192),
		),
	),
	'ImageableForTests' => array(
		'path'      => 'ImageableForTests_:id_:image_width.:file_extension',
		'sizes'     => array(
			array('width' => 266, 'height' => 266),
			array('width' => 532, 'height' => 532),
		),
	)
);
