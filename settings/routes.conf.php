<?php

$conf = array(

  'Controller' => array(
    'path' => '/:controller:',
    'defaults' => array(
      'controller' => 'main_page',
      'action' => 'display'
    )
  ),

  'ControllerAction' => array(
    'path' => '/:controller:/:action:',
    'defaults' => array( 'action' => 'display')
  ),

  'ControllerIdAction' => array(
    'path' => '/:controller/:action/:id',
  ),

);
