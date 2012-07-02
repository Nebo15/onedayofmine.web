<?php

$conf = array(

  'Controller' => array(
    'path' => '/:controller:',
    'defaults' => array(
      'controller' => 'main_page',
      'action' => 'display'
    )
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
