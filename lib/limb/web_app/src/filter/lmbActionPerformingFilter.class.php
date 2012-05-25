<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com 
 * @copyright  Copyright &copy; 2004-2009 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html 
 */
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

/**
 * class lmbActionPerformingFilter.
 *
 * @package web_app
 * @version $Id: lmbActionPerformingFilter.class.php 7486 2009-01-26 19:13:20Z pachanga $
 */
class lmbActionPerformingFilter implements lmbInterceptingFilter
{
  function run($filter_chain)
  {
    $dispatched = lmbToolkit :: instance()->getDispatchedController();
    if(!is_object($dispatched))
      throw new lmbException('Request is not dispatched yet! lmbDispatchedRequest not found in lmbToolkit!');

    $dispatched->performAction();

    $filter_chain->next();
  }
}


