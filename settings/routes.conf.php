<?php

$conf = array(

  'Controller' => array(
    'path' => '/:controller:',
    'defaults' => array(
      'controller' => 'main_page',
      'action' => 'display'
    )
  ),

  'MyAction' => array(
    'path' => '/my/:action:',
    'defaults' => array('controller' => 'users', 'action' => 'display')
  ),

  'MyDayAction' => array(
		'path' => '/my/days/:action:',
		'defaults' => array('controller' => 'days', 'action' => 'display')
	),

	'MyActionId' => array(
		'path' => '/my/:id:/:action:',
		'defaults' => array('controller' => 'users')
	),

  'MyControllerIdAction' => array(
    'path' => '/my/:controller/:id/:action/',
  ),

  'ControllerAction' => array(
    'path' => '/:controller:/:action:',
    'defaults' => array( 'action' => 'display')
  ),

  'ControllerIdAction' => array(
    'path' => '/:controller/:id/:action/',
  ),

);
