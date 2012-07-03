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
		
	'MyActionId' => array(
		'path' => '/my/:id:/:action:',
		'defaults' => array('controller' => 'users')
	),

  'MyControllerAction' => array(
    'path' => '/my/:controller:/:action:',
    'defaults' => array( 'action' => 'display')
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
